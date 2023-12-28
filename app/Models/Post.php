<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
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
