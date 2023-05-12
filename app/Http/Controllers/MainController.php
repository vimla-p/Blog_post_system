<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogView;
use Carbon\Carbon;


class MainController extends Controller
{
    //show all blogs in center of homepage
    public function showBlogs()
    {
        $arr = [];
        $blogs = Blog::with('users', 'categories')->where('is_active', true)->simplePaginate(10);

        foreach ($blogs as $key => $value) {
            $blog = Blog::with('users', 'categories')->where('is_active', true)->find($blogs[$key]->id);
            array_push($arr, $blog);
        }

        return view('homepage', compact('blogs', 'arr'));
    }

    //show single blog view page and increment count in blog table and update record in blog_views table if it is  exists
    public function showOneBlog($id)
    {
        $val = BlogView::whereDate('created_at', Carbon::today())->where('blog_id', $id)->with('blogs')->first();

        if ($val == null) {
            $blogView['blog_id'] = $id;
            $blogView['visited_count'] = 1;
            $blogView['created_at'] = now();
            BlogView::create($blogView);
        } else {
            $val->increment('visited_count');
            $val->save();
        }

        $blog = Blog::with('categories', 'users')->find($id);
        $blog->visited_count = ($blog->visited_count) + 1;
        $blog->save();
        return view('singleblog', compact('blog'));
    }
}
