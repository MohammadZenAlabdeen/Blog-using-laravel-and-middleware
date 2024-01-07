<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        if(auth()->check()){
        $comment=$request->only('content');
        $comment['post_id']=$id;
        auth()->user()->Comment()->create($comment);
        return response()->json(['status'=>'success','message'=>'commented successfully',],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        if(auth()->check()){
            if(Comment::where('id',$id)->exists()){
                $comment=Comment::where('id',$id)->first();
                if($comment->user_id===auth()->user()->id){
                    $comment->content=$request->input('content');
                    $comment->save();
                    return response()->json(['status'=>'success','message'=>'updated',201]);
                }
            }
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Comment::where('id',$id)->exists()){
            $comment=Comment::where('id',$id)->first();
            if($comment->user_id===auth()->user()->id){
                $comment->delete();
                return response()->json(['status'=>'success','message'=>'deleted',201]);
            }
        }
    }
    }

