<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20); // Collection

        return view ('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
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

    public function destroy(Post $post)
    {
        /*
        // uz funkciju ownedBy u Post modelu
        if (!$post->ownedBy(auth()->user())) {
            dd('no');
        }
        */

        // uz PostPolicy
        $this->authorize('postDelete', $post);

        $post->delete();

        return back();
    }
}
