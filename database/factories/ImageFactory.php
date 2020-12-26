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
            'url' => $this->faker->randomElement(
                [
                    '/images/caroline-sellers-oh5uPOTOwYQ-unsplash.jpg',
                    '/images/masha-fathi-_PL4luMSMpM-unsplash.jpg',
                    '/images/june-gathercole-iSbjp3HiCdY-unsplash.jpg',
                    '/images/melanie-andersen-4imykgmUTSs-unsplash.jpg',
                    '/images/donald-tran-x-5HiKcd56g-unsplash.jpg',
                    '/images/valentina-CYmvIYpj3NQ-unsplash.jpg',
                    '/images/giorgio-trovato-CVDMTrWif9c-unsplash.jpg',
                    '/images/t-bortolus-b_TNvYBcX4w-unsplash.jpg',
                    '/images/josephine-i-5XkJcgpEURg-unsplash.jpg',
                    '/images/lilian-joore-i5lyn6B5KZo-unsplash.jpg',
                    '/images/kevin-bree-q5FGsXNFtbk-unsplash.jpg',
                ]
            ),
            //Assigns each image to a random post
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
