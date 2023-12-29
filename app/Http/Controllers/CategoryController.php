<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::all();
        return view('category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { if(auth()->user()->isAdmin===1){
        return view('category.create');
    }else{
        return redirect()->back();
    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category=new Category();
        $category->name=$request->input('name');
        $image = $request->file('img');
        $imageName= time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'),$imageName);
        $category->img=$imageName;
        $category->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.view',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if(auth()->user()->isAdmin===1){
        return  view('category.edit',compact('category'));
    }else{
        return redirect()->back();
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name=$request->input('name');
        $image = $request->file('img');
            $imageName= time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
            $category->img=$imageName;
            $category->save();
            return  redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(auth()->user()->isAdmin===1){
        $category->delete();
        return  redirect()->route('category.index');
    }}
}
