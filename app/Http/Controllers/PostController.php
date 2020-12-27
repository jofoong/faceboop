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
        $posts = Post::paginate(10);
        //return view("posts/index", ["posts"=>Post::get()->sortByDesc('timestamps')]);
        return view("posts/index", ["posts"=>Post::simplePaginate(10)]);
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
        
        /*$p->tags()->sync($request->get('tags'));
        else {
            $p->tags()->sync(array());
        }*/
        
        
        foreach (Tag::get() as $tag) {
           if (isset($request[$tag->tag])) {
                $p->tags()->attach($tag->id);  
           }
        }
        
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            //$imagePath = $request->file('image')->storeAs('images', $image);
            //$p->update(['image'=>$image]);

            $image = new Image;
            $image->image = $imageName;
            $image->post_id = $p->id;
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

            $post = Post::findOrFail($post_id);
            $post->title = $validated['title'];     
            $post->content = $validated['content'];     
            $post->edited = 'Edited at ' . $post->created_at;
            $post->save();

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
