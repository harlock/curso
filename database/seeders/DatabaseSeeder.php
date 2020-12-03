<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CopyFilm;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        Genre::factory(6)->create();
        Film::factory(15)->create();
        Comment::factory(100)->create();
        CopyFilm::factory(300)->create();
        Rental::factory(1500)->create();
    }
}
