<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'reply' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string']
        ]);

        $id = $request->cookie('id');

        $reply = Comment::create([
            'reply' => $request['reply'],
            'user_id' => Auth::user()->id,
            'tweet_id' => $request['id'],
        ]);
        
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'reply' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalName();
            $fileName = $fileExtension;
            $request->file('image')->move(public_path('images'), $fileName);
            $comment->image = $fileName;
        } else {
            //$fileName = FALSE;
        }
        
        $comment->reply = $request['reply'];
        $comment->save();
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $selectComment = $comment->find($comment->id);
        $selectComment->delete();
        return back();
    }
}
