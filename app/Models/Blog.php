<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class Blog extends Model
{
    use HasFactory, SoftDeletes;
    // protected $appends=['categories'];
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'image',
        'visited_count',
    ];

    
    
    public function getRouteKeyName()
    {   
         return "slug";
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'blog_category','blog_id','category_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function blogViews(){
        return $this->hasMany(BlogView::class, 'blog_id');
    }
   

}
