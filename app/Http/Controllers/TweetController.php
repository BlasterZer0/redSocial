<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $tweets = Tweet::orderBy('created_at')->paginate(5);
       // return view('index')->with('tweets',$tweets);
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
            //'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

       /* if($request->hasFile('image')){
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalName();
            $fileName = $fileExtension;
            $request->file('image')->move(public_path('images'), $fileName);
        }*/
        
        $tweets = Tweet::create([
            'text' => $request['text'],
            //'image' => $fileName
            'user_id' => Auth::user()->id,
        ]);
        
        //Session::flash('mensaje', 'Registro Creado con Exito!');
        //$request->session()->flash('mensaje', 'Registro Creado con Exito!');
        
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweets)
    {
        //
    }
}
