<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//homepage
Route::get('/', [MainController::class, 'showBlogs'])->name('showblogs'); //->middleware('activeUsers');
Route::get('blog/{id}', [MainController::class, 'showOneBlog'])->name('blog');


//store data of registered user
Route::post('registeruser', [AuthenticateController::class, 'registerUser'])->name('registeruser');


//blade files
Route::view('singlepage', 'singleblog')->name('singlepage');
Route::view('/users', 'backend/user/list')->name('users');
Route::view('/adduser', 'backend/user/create')->name('adduser');
Route::view('/edituser', 'backend/user/edit')->name('edituser');

Route::view('/blogs', 'backend/blog/list')->name('blogs');
Route::view('/addblog', 'backend/blog/create')->name('addblog');
Route::view('/editblog', 'backend/blog/edit')->name('editblog');

Route::view('/categories', 'backend/category/list')->name('categories');
Route::view('/addcategory', 'backend/category/create')->name('addcategory');
Route::view('/editcategory', 'backend/category/edit')->name('editcategory');

Route::view('/profile', 'backend/profile')->name('profileview');



//user operation
Route::get('userdash', [UserController::class, 'Dashboard'])->middleware('auth')->name('userdash'); 
Route::get('changestatus', [UserController::class, 'changeStatus'])->middleware('auth')->name('changestatus');
Route::get('profile/{id}', [UserController::class, 'profile'])->middleware('auth')->name('profile');


Route::get('listuser', [UserController::class, 'listUser'])->middleware('auth')->name('listuser');
Route::post('createuser', [UserController::class, 'createUser'])->middleware('auth')->name('createuser');
Route::get('updateuser/{id}', [UserController::class, 'editUser'])->middleware('auth')->name('updateuser');
Route::post('updateusertable/{id}', [UserController::class, 'UpdateUser'])->middleware('auth')->name('updateusertable');
Route::get('deleteuser/{id}', [UserController::class, 'deleteUser'])->middleware('auth')->name('deleteuser');
Route::get('changeuserstatus', [UserController::class, 'changeUserStatus'])->middleware('auth')->name('changeuserstatus');
Route::get('searchuser', [UserController::class, 'searchUser'])->middleware('auth')->name('searchuser');



//blog  operation
Route::get('listblog', [BlogController::class, 'listBlog'])->middleware('auth')->name('listblog');
Route::post('createblog', [BlogController::class, 'createBlog'])->middleware('auth')->name('createblog');
Route::get('fillblog/{slug}', [BlogController::class, 'editBlog'])->middleware('auth')->name('fillblog');
Route::post('updateblog/{slug}', [BlogController::class, 'UpdateBlog'])->middleware('auth')->name('updateblog');
Route::get('deleteblog/{id}', [BlogController::class, 'deleteBlog'])->middleware('auth')->name('deleteblog');
Route::get('changeblogstatus', [BlogController::class, 'changeBlogStatus'])->middleware('auth')->name('changeblogstatus');
Route::get('create', [BlogController::class, 'create'])->middleware('auth')->name('create');
Route::post('createblogslug', [BlogController::class, 'createSlug'])->middleware('auth')->name('createblogslug');
Route::post('editblogslug', [BlogController::class, 'editSlug'])->middleware('auth')->name('editblogslug');



//category operation
Route::get('listcategory', [CategoryController::class, 'listCategory'])->middleware('auth')->name('listcategory');
Route::post('createcategory', [CategoryController::class, 'createCategory'])->middleware('auth')->name('createcategory');
Route::get('fillcategory/{slug}', [CategoryController::class, 'editCategory'])->middleware('auth')->name('fillcategory');
Route::post('updatecategory/{slug}', [CategoryController::class, 'updateCategory'])->middleware('auth')->name('updatecategory');
Route::get('deletecategory/{id}', [CategoryController::class, 'deleteCategory'])->middleware('auth')->name('deletecategory');
Route::get('changecategorystatus', [CategoryController::class, 'changeCategoryStatus'])->middleware('auth')->name('changecategorystatus');
Route::get('searchcategory', [CategoryController::class, 'searchCategory'])->middleware('auth')->name('searchcategory');
Route::post('createslug', [CategoryController::class, 'createSlug'])->middleware('auth')->name('createslug');
Route::post('editslug', [CategoryController::class, 'editSlug'])->middleware('auth')->name('editslug');
Route::get('sortcategory', [CategoryController::class, 'sortCategory'])->middleware('auth')->name('sortcategory');




