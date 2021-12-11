<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use Illuminate\Http\Request;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostImage  $postImage
     * @return \Illuminate\Http\Response
     */
    public function show(PostImage $postImage)
    {
        //
    }

    public function showPostOfImage($postId) {
        $needed_image = PostImage::where('post_id', $postId)->latest()->get();

        return response()->json($needed_image, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostImage  $postImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PostImage $postImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostImage  $postImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostImage $postImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostImage  $postImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostImage $postImage)
    {
        //
    }
}
