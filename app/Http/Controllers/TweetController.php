<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$tweets = Tweet::orderBy('id', 'desc')->paginate(5);
        //return view('index')->with('tweets',$tweets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalName();
            $fileName = $fileExtension;
            $request->file('image')->move(public_path('images'), $fileName);
        } else {
            $fileName = FALSE;
        }
        
        $tweet = Tweet::create([
            'text' => $request['text'],
            'user_id' => Auth::user()->id,
            'image' => $fileName,
        ]);
        
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        $user = User::orderBy('id', 'desc');
        $comments = Tweet::find(1)->comments;
        return view('tweet.tweet')->with('tweet', $tweet, 'comments', $comments)->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        $this->authorize('update', $tweet);

        $request->validate([
            'text' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalName();
            $fileName = $fileExtension;
            $request->file('image')->move(public_path('images'), $fileName);
            $tweet->image = $fileName;
        } else {
            //$fileName = FALSE;
        }
        
        $tweet->text = $request['text'];
        $tweet->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet, Comment $comment)
    {
        $this->authorize('delete', $tweet);

        $selectTweet = $tweet->find($tweet->id);
        $tweet->comments()->delete();
        $selectTweet->delete();
        return redirect()->route('index');
    }
}
