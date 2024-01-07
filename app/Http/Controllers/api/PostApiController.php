<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->check()){
        $posts=Post::all();
        return response()->json($posts,200);
    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->check()){
        $request->validate(
            [
                'title'=>'required',
                'description'=>'required',
                'img'=>'image'
            ]);
           $post=$request->only(['title','description']);
            $image = $request->file('img');
            $imageName= time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
            $post['img']=$imageName;
            $post['category_id']=$request->input('category_id');
            auth()->user()->Post()->create($post)->Tag()->sync($request->input('tag'));            
            return response()->json(['status' => 'success'],200);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(auth()->check()){
        $post=Post::where('id',$id)->get();
        $comments=Comment::where('post_id',$id)->get();
        return response()->json([
            'status'=>'success',
            'post' => $post,
            'comments' => $comments,
        ],200);
    }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    { if(auth()->check()){
            if(Post::where('id',$id)->exists()){
            $post=Post::where('id',$id)->first();
            if($post->user_id===auth()->user()->id){
            $post->title=$request->input('title');
            $post->description=$request->input('description');
            if($request->hasFile('img')){
                $image = $request->file('img');
                $imageName= time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'),$imageName);
                $post->img=$imageName;
            }
            $post->save();
            $post->Tag()->sync($request->input('tag'));  
            return response()->json([
                'status' => 'success',
                'message' => 'post updates successfully',
            ],201);}}else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'problem',
                ],404);
            }
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {if(auth()->check()){
        $post=Post::where('id',$id)->first();
        if(auth()->user()->id===$post->user_id){
        $post->delete();
        return response()->json(['status'=>'success','message'=>'post deleted successfully',],201);
    }}
}
}
