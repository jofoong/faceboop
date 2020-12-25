<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $validated = $request->validate([
            'image' => 'required|image|dimensions:min_width=100,min_height=200',
        ]);
        
        $p = new Post;
        $p->title = $validated['title'];
        $p->content = $validated['content'];
        $p->user_id = $user_id;
        $p->save();
        foreach (Tag::get() as $tag) {
           if (! ($request[$tag->tag] === null)) {
              $p->tags()->attach($tag->id);   
           }
        }

        session()->flash('message', 'Post created!');
        return redirect()->route('homepage');
    }
}
