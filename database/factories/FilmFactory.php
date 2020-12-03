<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->realText(rand(80, 600)),
            'release_date'=>$this->faker->date(),
            'rating' => rand(1,5),
            'genre_id' => function () {
                // Get random genre id
                return Genre::inRandomOrder()->first()->id;
            },
            'photo'  => 'https://via.placeholder.com/350x150',
            'slug'   => str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($this->faker->sentence(5))))),
            'rental_price'=> rand(100,350)

        ];
    }
}
