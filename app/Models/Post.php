<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Policies\PostPolicy;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
    'title','description','img','user_id','category_id'
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function Tag(){
        return $this->belongsToMany(Tag::class);
    }
    public function Comment(){
        return $this->hasMany(Comment::class);
    }
}
