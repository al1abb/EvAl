<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $users = User::paginate(20);

        $users->map(function($user) {

            $user['admin'] = $user->admin;
            $user['agency'] = $user->agency;
            $user['posts'] = $user->posts;
            $user['flags'] = $user->flags;
            
            return $user;
        });
        
        return response()->json($users, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    // ! Unused method. Delete later
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource
     * 
     * @param  \ID $id
     */
    public function show($id) {
        $asked_user = User::findOrFail($id);

        $asked_user['admin'] = $asked_user->admin;
        $asked_user['agency'] = $asked_user->agency;
        $asked_user['posts'] = $asked_user->posts;
        $asked_user['flags'] = $asked_user->flags;
        
        return response()->json($asked_user, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Display posts of the user
     * 
     * @param  \ID $id
     */
    public function showUserPosts($id) {
        $asked_user = User::findOrFail($id);
        $asked_user_posts = $asked_user->posts; 

        return response()->json($asked_user_posts, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Display agency of the user
     * 
     * @param  \ID $id
     */
    public function showUserAgency($id) {
        $asked_user = User::findOrFail($id);
        $asked_user_agency = $asked_user->agency;

        return response()->json($asked_user_agency, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    public function showUserFlags($id) {
        $asked_user = User::findOrFail($id);
        $asked_user_flags = $asked_user->flags;

        return response()->json($asked_user_flags, 200, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    // ? Possible refactor in validation
    public function update($id) {
        $user = User::findOrFail($id);
        $fields = request()->validate([
            'name' => 'string',
            'email' => 'string|unique:users,email|email',
            'password' => 'string|confirmed'
        ]);

        $user->update($fields);

        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage
     * 
     * @param  \ID $id
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
