<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Comment;
        $a->comment = 'Bump';
        $a->user_id = 2;
        $a->post_id = 1;
        $a->save();

        Comment::factory()->times(300)->create();
    }
}
