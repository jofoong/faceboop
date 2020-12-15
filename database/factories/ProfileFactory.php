<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;
    protected $i = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->i += 1;
        return [
            'bio' => $this->faker->sentence(),
            'location' => $this->faker->city(),
            //Generate from an array of dog breeds
            'breed' => $this->faker->randomElement(
                ['Border Collie', 'Pekingese', 'Golden Retriever', 'Bullmastiff', 'Irish Terrier',
                'Lakeland Terrier', 'Samoyed', 'American Cocker Spaniel', 'Great Dane', 
                'Siberian Husky', 'Shetland Sheepdog', 'Cavalier King Charles']),
            //Ensure that each Profile is associated with only one Dog
            'dog_id' =>$this->i,
        ];
    }
}
