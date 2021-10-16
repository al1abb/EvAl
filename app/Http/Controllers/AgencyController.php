<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::paginate(20);

        // include agency users
        $agencies->map(function($agency) {
            $agency['users'] = $agency->users;
            return $agency;
        });

        $agencies->map(function($agency) {
            $agency['posts'] = $agency->posts;
            return $agency;
        });

        
        return response()->json($agencies, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'agency_name' => ['string', 'required', 'max:40', 'unique:agencies,agency_name'],
            'agency_description' => ['string', 'required', 'max:70'],
        ]);

        Agency::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asked_agency = Agency::where('id', $id)->firstOrFail();

        // $asked_agency['users'] = $asked_agency->users;

        return response()->json($asked_agency, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Show the users of a specified agency
     */
    public function showAgencyUsers($id) {
        $asked_agency = Agency::where('id', $id)->firstOrFail();

        $asked_agency['users'] = $asked_agency->users;

        return response()->json($asked_agency, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $attributes = request()->validate([
            'agency_name' => ['string', 'required', Rule::unique('agencies')->ignore($user)],
            'agency_description' => ['string', 'required', 'max:70'],
            // 'agency_logo' => ['file']
        ]);

        $user->update($attributes);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asked_agency = Agency::where('id', $id)->firstOrFail();
        $asked_agency->delete();
    }
}
