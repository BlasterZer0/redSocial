<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'auth.session'])->group(function () {

    Route::get('/home', function () {
        $tweets = Tweet::orderBy('id', 'desc')->paginate(10);
        $user = DB::table('users')->inRandomOrder();
        return view('home')->with('tweets',$tweets)->with('user', $user);
    })->name('index');
    
    Route::resource('tweet', TweetController::class);
    
    Route::resource('comment', CommentController::class);
});