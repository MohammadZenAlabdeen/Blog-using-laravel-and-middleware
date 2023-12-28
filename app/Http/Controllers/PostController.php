<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use lluminate\Database\Eloquent\Collection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Post::class);
        $posts=Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Post::class);
        $tags=Tag::all();
        $category=Category::all();
        return view('posts.create',compact('tags','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            $category_id=$request->input('category');
            $category_id=Category::where('name',$category_id)->get();
            foreach($category_id as $c){
                $arr=$c;
            }
            $post['category_id']=$arr->id;
            auth()->user()->Post()->create($post)->Tag()->sync($request->input('tag'));            
            return redirect()->route('posts.index');
            
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view',$post);
        $comments=Comment::where('post_id',$post->id)->get();
        return view('posts.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        $tags=Tag::all();
        $category=Category::all();
        return view('posts.update',compact('post','tags','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title'=>'required',
                'description'=>'required',
                'img'=>'image'
            ]);
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
            return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
