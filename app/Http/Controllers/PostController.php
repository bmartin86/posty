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

        /* koristeći array
        * $request->user()->posts()->create([
        *    'body' => $request->body
        * ]);
        */

        // skraćena sintaksa kad predajemo samo jedan parametar
        $request->user()->posts()->create($request->only('body'));

        return back();

        /* ili drugi način
        * Post::create([
        *     'user_id' => auth()->user()->id,
        *    // skraćeno 
        *    // 'user_id' => auth()->id(),
        *    'body' => $request->body
        * ]);
        */
    }
}
