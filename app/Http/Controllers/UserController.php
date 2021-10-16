<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(20);

        // $users->map(function($user) {
        //     if($user->agency == null) 
        //     {
        //         $user['agency'] = 'No Agency';
        //     }
        //     else {
        //         $user['agency'] = [$user->agency];
        //     }

        //     $user['posts'] = $user->posts;
        //     return $user;
        // });
        
        return response()->json($users, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function store(Request $request) {
        
    }

    public function show($id) {
        $asked_user = User::where('id', $id)->firstOrFail();

        // $asked_user['agency'] = $asked_user->agency;
        

        return response()->json($asked_user, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    public function showUserPosts($id) {
        $asked_user = User::where('id', $id)->firstOrFail();
        $asked_user_posts = $asked_user->posts;

        return response()->json($asked_user_posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function showUserAgencies($id) {
        $asked_user = User::where('id', $id)->firstOrFail();
        $asked_user_agency = $asked_user->agency;

        return response()->json($asked_user_agency, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function update($id) {

    }

    public function destroy($id) {

    }
}
