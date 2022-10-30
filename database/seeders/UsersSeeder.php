<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Oliveira',
            'email' => 'daniel@oliveira.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'Alfredo Silva',
            'email' => 'alfredo@oliveira.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
