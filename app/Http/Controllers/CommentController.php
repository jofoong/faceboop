<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id, $post_id)
    {
        $validated = $request->validate([
            'comment' => 'required|max:255',
        ]);
        
        $p = new Comment;
        $p->comment = $validated['comment'];            
        $p->user_id = $user_id;
        $p->post_id = $post_id;
        $p->save();

        session()->flash('message', 'Comment posted!');
        return view("posts/show", ["post"=>Post::findOrFail($post_id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        $currentComment = Comment::findOrFail($comment);
        return view("comments/show", ["comment"=>$currentComment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment_id)
    {
        $validated = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = Comment::findOrFail($comment_id);
        $comment->comment = $validated['comment'];      
        $comment->edited = 'Edited at ' . $comment->created_at;
        $comment->save();

        session()->flash('message', 'Comment edited.');
        return redirect()->route('posts.show', [Post::find($comment->post_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash('message', "Comment deleted. Jamie still managed to get a screenshot though. It's already posted on twitter.");
        return redirect()->route('posts.show', [Post::find($comment->post_id)]);
    }
}
