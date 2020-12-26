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
        $a->url = '/images/default_profile_pic.png';
        $a->post_id = 1;
        $a->save();

        Image::factory()->times(20)->create();
    }
}