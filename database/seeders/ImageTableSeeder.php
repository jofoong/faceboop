<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;


class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Image;
        $a->imageable_id = 1;
        $a->imageable_type = 'App\Models\Post';
        $a->image = 'caroline-sellers-oh5uPOTOwYQ-unsplash.jpg';
        $a->save();

        Image::factory()->times(20)->create();
    }
}