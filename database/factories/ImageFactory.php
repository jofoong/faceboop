<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->randomElement(
                [
                    'caroline-sellers-oh5uPOTOwYQ-unsplash.jpg',
                    'masha-fathi-_PL4luMSMpM-unsplash.jpg',
                    'june-gathercole-iSbjp3HiCdY-unsplash.jpg',
                    'melanie-andersen-4imykgmUTSs-unsplash.jpg',
                    'donald-tran-x-5HiKcd56g-unsplash.jpg',
                    'valentina-CYmvIYpj3NQ-unsplash.jpg',
                    'giorgio-trovato-CVDMTrWif9c-unsplash.jpg',
                    't-bortolus-b_TNvYBcX4w-unsplash.jpg',
                    'josephine-i-5XkJcgpEURg-unsplash.jpg',
                    'lilian-joore-i5lyn6B5KZo-unsplash.jpg',
                    'kevin-bree-q5FGsXNFtbk-unsplash.jpg',
                ]
            ),
            //Assigns each image to a random post
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
