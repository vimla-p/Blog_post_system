<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
    ];
    public function getRouteKeyName()
    {   
         return "slug";
    }

    public function blogs(){
        return $this->belongsToMany(Blog::class,'blog_category');
    }
}
