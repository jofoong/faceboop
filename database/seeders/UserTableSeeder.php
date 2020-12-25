<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $a->name = 'bestBoi86';
        $a->email = 'bestBoi86@yaooo.com';
        $a->password = Hash::make('itsme');
        $a->save();

        $admin = new User;
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin');
        $admin->role = 'admin';
        $admin->save();

        User::factory()->times(100)->create();
    }
}
