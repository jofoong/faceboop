<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Post;
        $a->title = 'Human eating chocolate';
        $a->content = 'I(13F) found my human (?M) eating chocolate. Please advise medical help.';
        $a->user_id = 1;
        $a->save();

        Post::factory()->times(20)->create();
    }
}
