<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Tag;
        $a->tag = 'medical';
        $a->save();

        $a->posts()->attach(1);
        $a->posts()->attach(10); //attach to random post
        Tag::factory()->times(7)->create();

        $posts = Post::get();
        $tags = Tag::get();
        //Attach to some posts, some tags.
        for ($i = 0; $i < count($posts); $i++)
        {
            Tag::inRandomOrder()->first()->posts()->attach(Post::inRandomOrder()->first()->id);
        }
    }
}
