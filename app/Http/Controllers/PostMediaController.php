<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostMediaController extends Controller
{
    public function index() {
        
    }

    public function show($id) {
        $post = Post::find($id);

        $media = $post->getFirstMedia('posts');

        return response()->json($media, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
