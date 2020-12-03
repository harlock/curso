<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\CopyFilm;
use Illuminate\Database\Eloquent\Factories\Factory;

class CopyFilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CopyFilm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'film_id'=>function(){
                return Film::inRandomOrder()->first()->id;
            }

        ];
    }
}
