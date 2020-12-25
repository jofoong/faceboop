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
        $a->tag = 'help';
        $a->save();

        $a->posts()->attach(1);
        $a->posts()->attach(10); //attach to random post
        Tag::factory()->times(7)->create();

        $posts = Post::get();
        //Attach to some Posts, some Tags.
        for ($i = 0; $i < count($posts); $i++)
        {
            $currentPostID = Post::inRandomOrder()->first()->id;
            $currentTag = Tag::inRandomOrder()->first();
           
            //make a check if the Tag had already been attached
            if ($currentTag->posts->find($currentPostID) == null)
            {
                $currentTag->posts()->attach($currentPostID);
            }
        }
    }
}
