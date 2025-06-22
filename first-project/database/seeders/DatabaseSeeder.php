<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//default olarak databaseseeder çalışır.
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //10 tane user oluşturuyor.
        // User::factory(10)->create();
         //15 tane örnek oluşturuyoruz
         Post::factory(2)->create();
    }
}
