<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new User;
        $a->username = 'bestBoi86';
        $a->email = 'bestBoi86@yaooo.com';
        $a->password = 'itsme';
        $a->save();

        User::factory()->times(100)->create();
    }
}
