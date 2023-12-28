<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.login');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');

    }
    public function login(Request $request){
        if(auth()->check()){
            return redirect()->route('posts.index');
        }
        $credentials = $request->validate([
            'email' => 'required| email',
            'password' =>'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('posts.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate(
            [
                'email'=>'required|email|unique:users',
                'name'=>'required|string',
                'password'=>'min:8|string|required',
                'img'=>'image'
            ]
            );
        $user=new User();
        $user->name=$validated['name'];
        $user->email=$validated['email'];
        $user->Password = Hash::make($validated['password']);
        $image = $validated['img'];
        $imageName= time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'),$imageName);
        $user->img=$imageName;
        $user->save();
        Auth::login($user);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
