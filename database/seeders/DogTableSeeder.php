<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dog;

class DogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Dog;
        $a->username = 'bestBoi86';
        $a->email = 'bestBoi86@yaooo.com';
        $a->password = 'itsme';
        $a->save();

        Dog::factory()->times(100)->create();
    }
}
