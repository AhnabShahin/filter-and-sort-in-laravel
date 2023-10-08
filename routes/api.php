<?php

use App\Http\Controllers\ObserverCheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/save', function () {
    $user = new User();
    $user->name = "Shahin";
    $user->email = Str::random(5) . "@gmail.com";
    $user->password = "1234";
    $user->save();

    $post = new Post();
    $post->title = "my title";
    $post->category = "my category". Str::random(5);
    $post->content = "my content ". Str::random(5);
    $post->image = Str::random(5) . "image";
    $post->user_id = $user->id;
    $post->save();
    return 'User inserted along with a post. User ID is : '.$user->id;
});


Route::get('/users', function () {
    $users = User::with('posts')->filter()->sort()->get();
    return $users;
});