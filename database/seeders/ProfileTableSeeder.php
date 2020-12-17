<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Profile;
        $a->bio = 'Open to polymorphic relationships';
        $a->location = 'Yorkshire';
        $a->breed = 'Beagle';
        $a->user_id = 1;
        $a->save();

        Profile::factory()->times(100)->create();
    }
}
