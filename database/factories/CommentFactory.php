<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Dog;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //Generate from an array of predefineds comments
            'comment' => $this->faker->randomElement(
                ['this','Can you elaborate?','I dont believe you..',
                'is this a repost?', 'YAAS QWEEN!', 'and then?','And thus a new catchphrase is born.',
                'I just want the scritches', 'I have no idea what im doing', 'saving this for later.']),
            //Assign each Comment to a random Dog
            'dog_id' => Dog::inRandomOrder()->first()->id,
            //Assign each Comment in a random Post
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
