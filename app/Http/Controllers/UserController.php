<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\password;
use function PHPUnit\Framework\isNull;
use App\Policies\UserPolicy;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.login');
    }
    public function admin(){
        if(auth()->user()->isAdmin===1){
            return true;
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',auth()->user());
        if(auth()->check() && $this->admin()){
            return view('users.createUser');
        }
        else return redirect()->back();
    }
    public function login(Request $request){
        if(auth()->check() && auth()->user()->ban===0){
            return redirect()->route('posts.index');
        }
        $credentials = $request->validate([
            'email' => 'required| email',
            'password' =>'required'
        ]);

        if (Auth::attempt($credentials)) {
            if(auth()->user()->ban===0){
            $request->session()->regenerate();
            return redirect()->route('posts.index');
        }else{
            $this->logout($request);
        }
    }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function register(Request $request)
    {        
        $this->authorize('create',auth()->user());
        if(auth()->check()&& $this->admin()){
        
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
        return redirect()->route('posts.index');
    }
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
    public function showUsers()
    {
        $this->authorize('viewAny',User::class);
        if($this->admin()){
        $users=User::all();
        return view('users.index',compact('users'));
    }
}
    public function trash()
    {
        $this->authorize('viewAny',User::class);
        if($this->admin()){
        $users=User::onlyTrashed()->get();
        return view('users.deleted',compact('users'));
    }
}
public function delete(User $user)
{
    $this->authorize('delete',auth()->user());
    if($this->admin()){
        $user->delete();
        return redirect()->route('users.showAll');
    }

    
}
public function destroy($id)
{
    
    if($this->admin()){
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->route('users.showAll');
    }

    
}

    /**
     * Update the specified resource in storage.
     */
    public function ban(User $user)
    {
        $this->authorize('ban',auth()->user());
        if($this->admin()){
        if($user->ban===0){
            $user->ban=true;
            $user->save();
        }
        else{
            $user->ban=false;
            
            $user->save();
        }
        return redirect()->route('users.showAll');
    }
}
    public function makeAdmin(User $user)
    {
        if($this->admin()){
        if($user->isAdmin===0){
            $user->isAdmin=true;
            $user->save();
        }
        else{
            $user->isAdmin=false;
            $user->save();
        }
        return redirect()->route('users.showAll');
    }
}
    public function restore($id)  {
        if($this->admin()){
        User::withTrashed()->find($id)->restore();
        return redirect()->route('users.trash');
}
    }

    /**
     * Remove the specified resource from storage.
     */

}
