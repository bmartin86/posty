<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view ('posts.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();

        /* ili drugi način
        Post::create([
            'user_id' => auth()->user()->id,
            // skraćeno 
            // 'user_id' => auth()->id(),
            'body' => $request->body
        ]);
        */
    }
}
