<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{
    //show all blogs if admin else user's blogs
    public function listBlog()
    {
        $blog = Blog::with('categories');

        if (Auth::user()->role == 'user') {
            $blog = $blog->where('user_id', '=', Auth::user()->id);
        }

        $blog = $blog->simplePaginate(5);
        return view('backend.blog.list', ['blog' => $blog]);
    }

    //return create blog page with all active categories
    public function create()
    {
        $category = Category::where('is_active', true)->get();
        return view('backend/blog/create', compact('category'));
    }

    //create blog 
    public function createBlog(BlogRequest $req)
    {
        $blog = $req->all();
        $blog['user_id'] = Auth::user()->id;
        $blog['visited_count'] = 0;
        $blog['image'] = uniqueImage($req->file('image'));
        $blogId = Blog::create($blog);

        //get id of categories and attach in blog_category table
        foreach ($req->category_ids as $value) {
            $blogId->categories()->attach($value);
        }

        //store file in public folder
        $req->file('image')->storeAs('public/blog/image', $blog['image']);

        return redirect()->route('listblog')->with(['message', "blog record created successfully"]);
    }

    //send  blog data to edit page
    public function editBlog($slug)
    {
        $data = Blog::with('categories')->where('slug', $slug)->first();
        $category = Category::where('is_active', true)->get();
        return view('backend/blog/edit', ['data' => $data, 'category' => $category]);
    }

    //update blog data
    public function UpdateBlog(BlogRequest $req, $slug)
    {
        $blogs = Blog::where('slug', $slug)->first();

        $blogs['user_id'] = Auth::user()->id;
        $blogs->title = $req->input('title');
        $blogs->slug = $req->input('slug');
        $blogs->description = $req->input('description');

        //check file is upload then update in table
        if ($req->hasFile('image')) {
            $blogs['image'] = uniqueImage($req->file('image'));
            $req->file('image')->storeAs('public/blog/image', $blogs['image']);
        }

        $blogs->save();

        $blogs->categories()->sync($req->category_ids);

        return redirect()->route('listblog')->with('message', "blog record updated successfully");
    }

    public function deleteBlog($id)
    {
        //delete from blogcategory when blog is deleted
        BlogCategory::where('blog_id', '=', $id)->delete();
        Blog::find($id)->delete();

        return redirect()->back()->with('message', "blog record deleted successfully");
    }

    //update status of blogs on ajax call
    public function changeBlogStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }

    //check the request slug is unique then return true else false in create blog page
    public function createSlug(Request $req)
    {
        $result = Blog::where('slug', $req->slug)->first();
        if ($result == null) {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        }
        return response()->json(['msg' => false]);
    }

    //check the request slug is unique except this Id then return true else false in edit blog page
    public function editSlug(Request $req)
    {
        $result = Blog::where('slug', $req->slug)->where('id', '=', $req->id)->first();
        if ($result) {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        } else if (Blog::where('slug', $req->slug)->first()) {
            return response()->json(['msg' => false]);
        } else {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        }
    }
}
