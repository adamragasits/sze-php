<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  // Változók
  $var = "Teszt";
  echo $var;

  echo $var . " szöveg";

  // Listák 
  $lista = ["elem1", "elem2", "elem3"];
  array_push($lista, "elem4");
  array_shift($lista);

  echo count($lista);
  echo $lista[0];

  // Logikai operátorok
  $a = 51;

  if($a > 50 && $a < 100) {
    echo "A szám 50 és 100 között van.";
  } elseif($a <= 50 || $a >= 100) {
    echo "A szám nem esik az előző tartományba.";
  } else {
    echo "A szám pontosan 50 vagy 100.";
  }

  // Pluszpontos feladat
  class PluszPont {
    private array $elemek;
    public string $name;
    public string $id;

    public function __construct(string $name, string $id) {
      $this->name = $name;
      $this->id = $id;
      $this->elemek = [];
    }

    public function add($elem) {
      array_push($this->elemek, $elem);
    }

    public function removeFirst(){
      array_shift($this->elemek);
    }

    public function getList() {
      return $this->elemek;
    }

    public function getString() {
      return $this->name . $this->id . count($this->elemek);
    }
  }

  $pluszPont = new PluszPont("Teszt", "0");
  $pluszPont->add("elem1");
  $pluszPont->add("elem2");
  $pluszPont->removeFirst();

  echo $pluszPont->getString();


  // HTTP metódusok
  $method = $_SERVER["REQUEST_METHOD"];
  
  echo $method;
  ?>
</body>
</html>