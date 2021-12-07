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
        $posts = Post::with(['user', 'agency'])->latest()->paginate(20);

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Display a listing of vip resource.
     */
    public function vipPosts() {
        $posts = Post::vipPosts()->latest()->paginate(20);

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Display a listing of VIP Posts between today and X months ago
     */
    // ? Add selectable period in month as a parameter
    public function vipPostsByPeriod() {
        if (request()->has('ay')) {
            $req = request()->input('ay');
        }

        $posts = Post::vipPostsByPeriod($req)->inRandomOrder()->paginate(8);

        return response()->json($posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function latestAgencyPosts() {
        $posts = Post::agencyPosts()->latest()->paginate(20);

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
            'area_unit' => 'string',
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

        $fields['user_id'] = auth()->id();
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
        $asked_post = Post::with(['user', 'agency'])->findOrFail($id);

        return response()->json($asked_post, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Display list of specified resources
     */
    public function showSelected() {
        $data = request()->all();
        // echo($data);
        // $data_array = json_decode($data, true);

        // echo(gettype($data_array));

        $asked_posts = Post::whereIn('id', $data)->latest()->get();

        return response()->json($asked_posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
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
        $post = Post::findOrFail($id);

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

        $fields['user_id'] = auth()->user->id ?? null;
        $fields['agency_id'] = auth()->user->agency ?? null;

        $post->update($fields);

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
        
        // check if post is currently logged in user's post
        if(auth()->user() == $post->user()) {
            $post->delete();
        }
        else {
            return response()->json('You do not have privileges', 403, [/*headers here*/], JSON_PRETTY_PRINT);
        }

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
            'priceMax' => 'integer',
            'areaMin' => 'nullable|integer',
            'areaMax' => 'nullable|integer',
            'floorMin' => 'nullable|integer',
            'floorMax' => 'nullable|integer',
            'vipCheckbox' => 'nullable|boolean',
            'agencyCheckbox' => 'nullable|boolean',
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

        if($fields['roomCount'] == '5+') {
            $roomCount = '5+';
        }
        else if($fields['roomCount'] == 'Hamısı') {
            $roomCount = 'Hamısı';
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

        $areaMin = $fields['areaMin'];
        $areaMax = $fields['areaMax'];

        $floorMin = $fields['floorMin'];
        $floorMax = $fields['floorMax'];

        $vipCheckbox = $fields['vipCheckbox'];
        $agencyCheckbox = $fields['agencyCheckbox'];

        // ALL POSTS
        $posts = Post::search($tradeType,
            $estateType,
            $roomCount,
            $city,
            $priceMin,
            $priceMax,
            $areaMin,
            $areaMax,
            $floorMin,
            $floorMax,
            $vipCheckbox,
            $agencyCheckbox
        )->inRandomOrder();

        // VIP POSTS
        $vipPosts = Post::search($tradeType,
            $estateType,
            $roomCount,
            $city,
            $priceMin,
            $priceMax,
            $areaMin,
            $areaMax,
            $floorMin,
            $floorMax,
            $vipCheckbox,
            $agencyCheckbox
        )->vipPosts()->inRandomOrder();
        
        // VOUCHER POSTS
        $voucherPosts = Post::search($tradeType,
            $estateType,
            $roomCount,
            $city,
            $priceMin,
            $priceMax,
            $areaMin,
            $areaMax,
            $floorMin,
            $floorMax,
            $vipCheckbox,
            $agencyCheckbox
        )->voucherPosts()->inRandomOrder();

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
