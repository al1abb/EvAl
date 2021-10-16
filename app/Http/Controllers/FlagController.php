<?php

namespace App\Http\Controllers;

use App\Models\Flag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flags = Flag::paginate(20);

        $flags->map(function($flag) {
            $flag['post'] = [$flag->post];
            $flag['user'] = [$flag->user];
            return $flag;
        });
        
        return response()->json($flags, 200, [/*headers here*/], JSON_PRETTY_PRINT);
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
     * @param  \App\Models\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asked_flag = Flag::where('id', $id)->firstOrFail();

        $asked_flag['post'] = $asked_flag->post;
        $asked_flag['user'] = $asked_flag->user;

        return response()->json($asked_flag, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flag $flag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asked_flag = Flag::where('id', $id)->firstOrFail();
        $asked_flag->delete();
        
    }
}
