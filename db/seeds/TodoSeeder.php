<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class TodoSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['name' => 'Ragasits Ádám', 'email' => 'adamragasits@gmail.com'],
            ['name' => 'Petyo', 'email' => 'petyo@gmail.com'],
        ];
 
        $this->table('users')->insert($data)->saveData();
    }
}
