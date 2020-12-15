<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->email(),
            'email_verified_at' => now(),
            'password'=> $this->faker->password(),
            'remember_token' => Str::random(10),
        ];
    }
}
