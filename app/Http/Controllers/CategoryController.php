<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use DataTables;


class CategoryController extends Controller
{
    //show all category to the admin
    public function listCategory()
    {
        $category = Category::simplePaginate(5);
        return view('backend/category/list', compact("category"));
    }

    //get data from create category page and store in category table
    public function createCategory(CategoryRequest $req)
    {
        $category = $req->all();
        Category::create($category);
        return redirect()->route('listcategory')->with('message', "category inserted successfully");
    }

    //send data to edit page 
    public function editCategory($slug)
    {
        $data = Category::where('slug', $slug)->first();
        return view('backend/category/edit', compact("data"));
    }

    //update data 
    public function updateCategory(CategoryRequest $req, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->name = $req->input('name');
        $category->slug = $req->input('slug');
        $category->save();
        return redirect()->route('listcategory')->with('message', "category updated successfully");
    }

    //delete category
    public function deleteCategory($id)
    {
        $category = BlogCategory::where('category_id', '=', $id)->get();
        if ($category != null) {
            return redirect()->back()->with('message', " this category assigns to blogs.");
        }
        $category = Category::find($id)->delete();
        return redirect()->back()->with('message', "category deleted successfully");
    }

    //update status of category on ajax call
    public function changeCategoryStatus(Request $request)
    {
        $user = Category::findOrFail($request->id);
        $user->is_active = $request->is_active;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }

    //check the request slug is unique then return true else false in create category page
    public function createSlug(Request $req)
    {
        $result = Category::where('slug', $req->slug)->first();
        if ($result == null) {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        }
        return response()->json(['msg' => false]);
    }

    //check the request slug is unique except this Id then return true else false in edit category page
    public function editSlug(Request $req)
    {
        if (Category::where('slug', $req->slug)->where('id', '=', $req->id)->first()) {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        } else if (Category::where('slug', $req->slug)->first()) {
            return response()->json(['msg' => false]);
        } else {
            return response()->json(['msg' => true, 'data' => Str::slug($req->slug)]);
        }
    }

    //custom search category and send ajax response
    public function searchCategory(Request $req)
    {
        if ($req->ajax()) {
            $data = Category::where('name', 'like', '%' . $req->value . '%')->get();

            $data= Datatables::of($data)->addIndexColumn()
                ->addColumn('is_active', function ($q) {
                    $checkedStatus = ($q->is_active == 1) ? 'checked' : '';
                    return $q = "<input type='checkbox' data-id='$q->id'
                 name='is_active' class='js-switch' $checkedStatus >";
                })
                ->addColumn('action', function ($q) {
                    return $q = "<button class='btn buttons-copy buttons-html5'
                 tabindex='0' aria-controls='example1'
                 type='button'><span><a
                         href='fillcategory/$q->slug'>
                         <i class='fas fa-edit'></i></a></span></button>
             <button class='btn buttons-copy buttons-html5'
                 tabindex='0' aria-controls='example1'
                 type='button'><span><a
                         onclick='return confirm('Are you sure to delete?')'
                         href='deletecategory/$q->id'>
                         <i class='fas fa-trash'></i></a></span></button>";
                })
                ->rawColumns(['is_active', 'action'])
                ->toJson();
            // dd($data->table());
            return $data;
        }
    }

    //TODO: custom sort 
    public function sortCategory(Request $req)
    {
        // dd($req->value);
        // dd(Str::lower($req->value));
        $data = Category::orderBy(Str::lower($req->value))->get();
        // dd($data);
        $data= Datatables::of($data)->addIndexColumn()
                ->addColumn('is_active', function ($q) {
                    $checkedStatus = ($q->is_active == 1) ? 'checked' : '';
                    return $q = "<input type='checkbox' data-id='$q->id'
                 name='is_active' class='js-switch' $checkedStatus >";
                })
                ->addColumn('action', function ($q) {
                    return $q = "<button class='btn buttons-copy buttons-html5'
                 tabindex='0' aria-controls='example1'
                 type='button'><span><a
                         href='fillcategory/$q->slug'>
                         <i class='fas fa-edit'></i></a></span></button>
             <button class='btn buttons-copy buttons-html5'
                 tabindex='0' aria-controls='example1'
                 type='button'><span><a
                         onclick='return confirm('Are you sure to delete?')'
                         href='deletecategory/$q->id'>
                         <i class='fas fa-trash'></i></a></span></button>";
                })
                ->rawColumns(['is_active', 'action'])
                ->toJson();

        return $data;

    }
}
