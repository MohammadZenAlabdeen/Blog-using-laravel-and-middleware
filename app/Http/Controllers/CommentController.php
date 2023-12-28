<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        $this->authorize('view',$post);
        $comments=Comment::where('post_id',$post->id)->get();
        return view('posts.show',compact('comment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Post $post)
    {
        $comment=$request->only('content');
        $comment['post_id']=$post->id;
        auth()->user()->Comment()->create($comment);
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view',$post);
        $comments=Comment::where('post_id',$post->id)->get();
        return view('posts.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->content=$request->input('content');
        $comment->save();
        return redirect()->route('posts.show',$comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        
        $comment->delete();
        return redirect()->back();
    }
}
