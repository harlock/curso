<?php

namespace Database\Factories;
use App\Models\Rental;

use App\Models\CopyFilm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rental::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'copy_film_id'=>function(){
                return CopyFilm::inRandomOrder()->first()->id;
            },
            'user_id'=>function(){
                return User::inRandomOrder()->first()->id;
            },
            'rental_date'=>$this->faker->dateTimeInInterval('-3 year', '+3 year'),

        ];
    }
}
