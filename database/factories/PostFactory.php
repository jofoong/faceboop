<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //Generate from an array of predefined titles
            'title' => $this->faker->randomElement(
                ['This guy for belly rubs' ,'One scratch vs two?', 'Best butt pat in town',
                'Location vs patting frequency', 'Lost squirrels', 'Neighbourhood feeders']),
            'content' => $this->faker->paragraph(),
            //Assigns each post to a random User
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
