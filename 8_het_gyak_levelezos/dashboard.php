<?php
  include_once 'config/restrict.php';
  include_once 'components/header.php';
  include_once 'config/db.php';

  $sql = "SELECT * FROM posts_l WHERE deleted IS FALSE";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result);
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="components/dashboard.css">
  <title>Document</title>
</head>
<body>
    <button class='newPostButton' onClick="window.location.href = 'newpost.php'">Új poszt írása...</button>
    <div class='postContainer'>
        <?php
            $username = $_SESSION['username'];
            foreach($rows as $row) {
                $canDelete = $row[1] === $username ? 'visible' : 'not-visible';

                $sql = "SELECT author, content, commented_at, id FROM comments_l WHERE post_id=$row[0] AND deleted=FALSE";
                $execute = mysqli_query($conn, $sql);
                $comments = mysqli_fetch_all($execute);

                $commentsToDoc = "";

                foreach ($comments as $comment) {
                    $canDeleteComment = $comment[0] === $username ? 'visible' : 'not-visible';
                    $commentsToDoc .= "
                        <div class='comment'>
                            <span style='font-weight: 600'>$comment[0]:</span> $comment[1] $comment[2]
                            <button onClick='deleteComment($comment[3])' class='post_delete_btn $canDeleteComment'>Törlés</button>
                        </div>
                    ";
                }

                echo "
                    <div class='post'>
                        <div class='author'>$row[1]</div>
                        <div class='description'>$row[3]</div>
                        <div class='posted_at'>$row[2]</div>
                        <div class='button_container'>
                            <input type='text' placeholder='Komment helye...' id='comment$row[0]'>
                            <button onClick='postComment($row[0])' class='post_comment_btn'>Komment írása</button>
                            <button onClick='deletePost($row[0])' class='post_delete_btn $canDelete'>Poszt törlése</button>
                        </div>
                        <hr class='divider'>
                        <div class='commentContainer'>
                            $commentsToDoc
                        </div>
                    </div>   
                ";
            }
        ?>        
    </div>
</body>

<script>
    function deletePost(id) {
        const confirmed = confirm("Biztosan törölni szeretnéd?");

        if(confirmed) {

        fetch(`api/deletepost.php?id=${id}`, {
            method: "POST"
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if(data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.log("Hiba történt: "+error);
        })
        }
    }

    function deleteComment(id) {
        const confirmed = confirm("Biztosan törölni szeretnéd?");

        if(confirmed) {

        fetch(`api/deletecomment.php?id=${id}`, {
            method: "POST"
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if(data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.log("Hiba történt: "+error);
        })
        }
    }


    function postComment(id) {
        const commentText = document.getElementById(`comment${id}`).value;

        fetch(`api/postcomment.php?id=${id}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    commentText: commentText
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if(data.success) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.log("Hiba történt: "+error);
        })
    }
</script>

</html>