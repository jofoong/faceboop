<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Image;
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
        return view("posts/index", ["posts"=>Post::simplePaginate(20)]);
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|'
        ]);
        
        $p = new Post;
        $p->title = $validated['title'];
        $p->content = $validated['content'];
        $p->user_id = $user_id;
        $p->save();

        //For every selected tag, store it to the post.
        foreach (Tag::get() as $tag) {
           if (isset($request[$tag->tag])) {
                $p->tags()->attach($tag->id);  
           }
        }
        
        //Save the image with its filename and extension.
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $image = new Image;
            $image->image = $imageName;
            $image->imageable_id = $p->id;
            $image->imageable_type = 'App\Models\Post';
            $image->save();

            $request->image->move(public_path('images'), $imageName);
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
        if (Gate::allows('isAdmin') || Gate::allows('update-post', Post::find($post_id))) {
            $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            ]);

            if ($request->hasFile('image')) {
                $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|']);
                $imageName = $request->file('image')->getClientOriginalName();
                $image = new Image;
                $image->image = $imageName;
                $image->imageable_id = $post_id;
                $image->imageable_type = 'App\Models\Post';
                $image->save();
    
                $request->image->move(public_path('images'), $imageName);
            }

            $post = Post::findOrFail($post_id);
            $post->title = $validated['title'];     
            $post->content = $validated['content'];     
            $post->edited = 'Edited at ' . $post->created_at;
            $post->save();

            //The post will have only the newly selected tags.
            $post->tags()->detach();
            foreach (Tag::get() as $tag) {
                if (isset($request[$tag->tag])) {
                     $post->tags()->attach($tag->id);  
                }
             }

            session()->flash('message', 'Post edited.');
            return redirect()->route('posts.show', [Post::find($post_id)]);  
        } else {
            abort(403); 
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
        $post->delete();
        session()->flash('message', 'Post deleted.');
        return redirect()->route('homepage');
    }
}
