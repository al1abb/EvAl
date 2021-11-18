<?php

namespace App\Http\Controllers;

use App\Models\Flag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flags = Flag::with(['post', 'user'])->paginate(20);
        
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
        $attributes = $request->validate([
            'flag_reason' => 'string'
        ]);

        $newFlag = Flag::create($attributes);

        return response()->json($newFlag, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  \ID $id
     */
    public function show($id)
    {
        $asked_flag = Flag::with(['post', 'user'])->findOrFail($id);

        return response()->json($asked_flag, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flag  $flag
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $flag = Flag::findOrFail($id);
        $attributes = request()->validate([
            'flag_reason' => 'string'
        ]);

        $flag->update($attributes);
        
        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ID $id
     */
    public function destroy($id)
    {
        $asked_flag = Flag::findOrFail($id);
        $asked_flag->delete();
        
        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
