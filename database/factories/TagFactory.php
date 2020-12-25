<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //An array of predefined tags
            'tag' => $this->faker->unique()->randomElement(
                ['location', 'request', 'funny', 'cats', 'general', 'skritches', 'play', 'medical']),
        ];
    }
}
