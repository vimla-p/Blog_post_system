<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\CreateUserEvent;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    //show if user is admin then admin dashboard else user's
    public function Dashboard()
    {
        if (Auth::user()->role === 'admin') {
            $countUser = User::count('id');
            $countBlog = Blog::count('id');
            $countCategory = Category::count('id');
            $data = Blog::with('categories')->where('is_active', false)->simplePaginate(5);
            return view('backend/user', ['countUser' => $countUser, 'countBlog' => $countBlog, 'countCategory' => $countCategory, 'data' => $data]);
        } else if (Auth::user()->role === 'user') {

            $blog = Blog::with(['categories'])->where('is_active', true)->where('user_id', Auth::user()->id)->simplePaginate(5);

            return view('backend/user', ['data' => $blog]);
        }
    }

    //update status of pending blogs on admin dashboard
    public function changeStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    //show profile page of user with user's data
    public function profile($id)
    {
        $data = User::find($id);
        return view('backend/profile', ['data' => $data]);
    }

    //show all user's data 
    public function listUser()
    {
        $user = User::simplePaginate(5);
        return view('backend/user/list', ['users' => $user]);
    }

    //craete user by admin 
    public function createUser(UserRequest $req)
    {
        $users = $req->all();
        $users['image'] = uniqueImage($req->file('image'));
        $password = Str::random(8);
        $users['password'] = Hash::make($password);
        $userData = User::create($users);

        //store image
        $req->file('image')->storeAs('public/user/image', $users['image']);

        //generate event to send mail to the created user with password
        event(new CreateUserEvent($userData, $password));

        return redirect()->route('listuser')->with('message', "user record inserted successfully");
    }

    //edit page with user's data
    public function editUser($id)
    {
        $data = User::find($id);
        return view('backend/user/edit', ['data' => $data]);
    }

    //update user
    public function UpdateUser(UserRequest $req, $id)
    {
        $users = User::find($id);
        $users->first_name = $req->input('first_name');
        $users->last_name = $req->input('last_name');
        $users->email = $req->input('email');
        $users->contact = $req->input('contact');
        if ($req->hasFile('image')) {
            $users['image'] = storeImage($req->file('image'));
            $req->file('image')->storeAs('public/user/image', $users['image']);
        }
        $users->save();

        return redirect()->route('listuser')->with('message', "user record updated successfully");;
    }

    //delete user
    public function deleteUser($id)
    {
        Blog::where('user_id', $id)->delete();
        User::find($id)->delete();
        return redirect()->back()->with('message', "user record deleted successfully");
    }

       //update status of users in admin dashboard
    public function changeUserStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }


//search user from table
    public function searchUser(Request $req)
    {
        $search = $req->value;
        $users = User::where('first_name', 'like', '%' . $search . '%')->get()->map(function ($data) {
            $checkedStatus = ($data->status == true) ? 'checked' : '';
            $data->status_html = '<input type="checkbox" data-id="' . $data->id . '"
            name="status" class="js-switch" ' . $checkedStatus . '>';
            $data->image_html = '<img class="w-25 h-25"  style="width :500px; height :500px;"
            src="' . asset("/storage/user/image/$data->image") . '"">';
            return $data;
        });


        return response()->json(['data' => $users->toArray()]);
    }

    //TODO
    public function search(Request $req)
    {
       
        // if ($req->ajax()) {
        //     $data = User::where('first_name', 'like', '%' . $search . '%')->get();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {

        //             $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

    }
}
