<?php

namespace App\Http\Controllers;

use App\Models\Flag;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(20);

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
        $posts = Post::vipPosts()->latest()->paginate(8);

        $posts->map(function($post) {
            $post['user'] = [$post->user];
            $post['agency'] = [$post->agency];
            return $post;
        });

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    // ? Possible refactor of the code
    // TODO: add api route for this method
    public function vipPostsByPeriod() {
        $posts = Post::vipPostsByPeriod(15)->inRandomOrder()->paginate(8);

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
        $fields = $request->validate([
            'estate_type' => 'string',

            'city' => 'string',
            'area' => 'integer',
            'room_count' => 'integer',
            'address' => 'string',
            'district' => 'string',

            'apartment_floor' => 'integer',
            'total_floors' => 'integer',

            'description' => 'string',
            'price' => 'integer',

            'contact_email' => 'email|unique:posts,contact_email',
            'contact_phone_number' => 'string',

            'trade_type' => 'string',
            'realtor_type' => 'string',

            'is_vip' => 'boolean',
            'has_voucher' => 'boolean'
        ]);

        $fields['user_id'] = auth()->user() ?? null;
        $fields['agency_id'] = auth()->user()->agency ?? null;
        $fields['views_today'] = 0;
        $fields['views_total'] = 0;

        $newPost = Post::create($fields);

        return response()->json($newPost, 200, [], JSON_PRETTY_PRINT);
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
    public function update($id)
    {
        $flag = Flag::findOrFail($id);

        $fields = request()->validate([
            'estate_type' => 'string',

            'city' => 'string',
            'area' => 'integer',
            'room_count' => 'integer',
            'address' => 'string',
            'district' => 'string',

            'apartment_floor' => 'integer',
            'total_floors' => 'integer',

            'description' => 'string',
            'price' => 'integer',

            'contact_email' => 'email|unique:posts,contact_email',
            'contact_phone_number' => 'string',

            'trade_type' => 'string',
            'realtor_type' => 'string',

            'is_vip' => 'boolean',
            'has_voucher' => 'boolean'
        ]);

        $fields['user_id'] = auth()->user() ?? null;
        $fields['agency_id'] = auth()->user()->agency ?? null;

        $flag->update($fields);

        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
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

    public function searchPost(Request $request) {

        $start = microtime(true);
        
        $fields = $request->validate([
            'tradeType' => 'required|string',
            'estateType' => 'string',
            'roomCount' => '',
            'city' => 'string',
            'priceMin' => 'integer',
            'priceMax' => 'integer'
        ]);

        if($fields['tradeType'] == 'Hamısı') {
            $tradeType = ['rent', 'sell'];
        } else {
            if($fields['tradeType'] == 'Alış') {
                $tradeType = ['sell'];
            }
            else {
                $tradeType = ['rent'];
            }
        }

        if($fields['estateType'] == 'Hamısı') {
            $estateType = ['apartment', 'new_apartment', 'house_villa', 'office', 'garage', 'land'];
        } else {
            if($fields['estateType'] == 'Mənzil') {
                $estateType = ['apartment'];
            }
            if($fields['estateType'] == 'Yeni Mənzil') {
                $estateType = ['new_apartment'];
            }
            if($fields['estateType'] == 'Ev-Villa') {
                $estateType = ['house_villa'];
            }
            if($fields['estateType'] == 'Ofis') {
                $estateType = ['office'];
            }
            if($fields['estateType'] == 'Qaraj') {
                $estateType = ['garage'];
            }
            if($fields['estateType'] == 'Torpaq') {
                $estateType = ['land'];
            }
        }

        if($fields['roomCount'] == 'Hamısı') {
            $roomCount = ['1', '2', '3', '4', '5'];
        }
        else {
            $roomCount = [$fields['roomCount']];
        }

        if($fields['city'] == 'Hamısı') {
            $city = ['Bakı', 'Sumqayıt', 'Gəncə'];
        }
        else {
           $city = [$fields['city']];
        }

        $priceMin = $fields['priceMin'];
        $priceMax = $fields['priceMax'];

        // if(empty($request->roomCount)) {
        //     $roomCount = 1
        // }
        
        // $posts = Post::where([
        //     ['trade_type', $tradeType],
        //     ['estate_type', $estateType],
        //     ['room_count', $roomCount],
        //     ['city', $city],
        //     ['price', '>=', $priceMin],
        //     ['price', '<=', $priceMax]
        // ]);

        $posts = Post::search($tradeType, $estateType, $roomCount, $city, $priceMin, $priceMax)->inRandomOrder();

        $vipPosts = Post::search($tradeType, $estateType, $roomCount, $city, $priceMin, $priceMax)->vipPosts()->inRandomOrder();
        
        $voucherPosts = Post::search($tradeType, $estateType, $roomCount, $city, $priceMin, $priceMax)->voucherPosts()->inRandomOrder();

        $searchResult['allPostsCount'] = $posts->count();
        $searchResult['vipPostsCount'] = $vipPosts->count();
        $searchResult['voucherPostsCount'] = $voucherPosts->count();

        $searchResult['allPosts'] = $posts->simplePaginate(20);
        $searchResult['vipPosts'] = $vipPosts->simplePaginate(8);
        $searchResult['voucherPosts'] = $voucherPosts->simplePaginate(20);

        $time = microtime(true) - $start;
        $searchResult['time'] = $time;
        
        return response()->json($searchResult, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
