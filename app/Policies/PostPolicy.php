<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    public function viewAny(User $user) {
        return true;
    }
    public function view(User $user,Post $post){
        return true;
    }
    public function create(User $user){
        return true;
    }
    public function update(User $user,Post $post){
        return $user->id===$post->user_id;
    }
    public function delete(User $user,Post $post){
        return $user->id===$post->user_id;
    }
}
