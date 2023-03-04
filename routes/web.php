<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Models\Tweet;
use App\Models\User;


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
Route::resource('tweet', TweetController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $tweets = Tweet::orderBy('id', 'desc')->paginate(5);
    return view('home')->with('tweets',$tweets);
})->name('index');

Route::get('/tweet/{id}', function () {
    return view('post');
});