<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(20);

        $posts->map(function($post) {
            $post['user'] = [$post->user];
            $post['agency'] = [$post->agency];
            return $post;
        });

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Display a listing of vip resource.
     */
    public function vipPosts() {
        $posts = Post::where('is_vip', true)->paginate(20);

        $posts->map(function($post) {
            $post['user'] = [$post->user];
            $post['agency'] = [$post->agency];
            return $post;
        });

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function showPostFlags($id) {
        $post = Post::findOrFail($id);
        $post_flags = $post->flags;

        return response()->json($post_flags, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \ID $id
     */
    public function show($id)
    {
        $asked_post = Post::findOrFail($id);
        $asked_post['user'] = $asked_post->user;
        $asked_post['agency'] = $asked_post->agency;

        return response()->json($asked_post, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ID $id
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
