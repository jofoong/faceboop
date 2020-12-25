<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("posts/index", ["posts"=>Post::get()->sortByDesc('timestamps')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $currentPost = Post::findOrFail($post_id);
        return view("posts.show", ["post"=>$currentPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("posts.edit", ["post"=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        if (! Gate::allows('update-post', Post::findOrFail($post_id))) {
            abort(403);
        } else {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            $post = Post::findOrFail($post_id);
            $post->title = $validated['title'];     
            $post->content = $validated['content'];     
            $post->edited = 'Edited at ' . $post->created_at;
            $post->save();
            foreach (Tag::get() as $tag) {
                if (! ($request[$tag->tag] === null)) {
                   $p->tags()->attach($tag->id);   
                }
            }

            session()->flash('message', 'Post edited.');
            return redirect()->route('posts.show', [Post::find($post_id)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (! Gate::allows('destroy-post', $post)) {
            abort(403);
        } else {
            $post->delete();
            session()->flash('message', 'Post deleted.');
        }
        
        return redirect()->route('homepage');
    }
}
