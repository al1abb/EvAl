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
     */
    public function index()
    {
        $agencies = Agency::paginate(20);

        $agencies->map(function($agency) {
            $agency['users'] = $agency->users;
            $agency['posts'] = $agency->posts;
            return $agency;
        });
        
        return response()->json($agencies, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'agency_name' => ['string', 'required', 'max:40', 'unique:agencies,agency_name'],
            'agency_description' => ['string', 'required', 'max:70'],
        ]);

        // return new agency as an instance because we will use it in return
        $newAgency = Agency::create($attributes);

        return response()->json($newAgency, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  \ID $id
     */
    public function show($id)
    {
        $asked_agency = Agency::findOrFail($id);

        $asked_agency['users'] = $asked_agency->users;
        $asked_agency['posts'] = $asked_agency->posts;

        return response()->json($asked_agency, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Show the users of a specified agency
     * 
     * @param  \ID $id
     */
    public function showAgencyUsers($id) {
        $asked_agency = Agency::findOrFail($id);

        $asked_agency_users = $asked_agency->users;

        return response()->json($asked_agency_users, 200, [/* headers */], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Agency  $agency
     */
    public function update($id)
    {
        $agency = Agency::findOrFail($id);
        $attributes = request()->validate([
            'agency_name' => ['string', 'required', Rule::unique('agencies')->ignore($agency)],
            'agency_description' => ['string', 'required', 'max:70'],
            // 'agency_logo' => ['file']
        ]);

        $agency->update($attributes);
        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ID $id
     */
    public function destroy($id)
    {
        $asked_agency = Agency::findOrFail($id);
        $asked_agency->delete();

        return response()->json([], 204, [/*headers here*/], JSON_PRETTY_PRINT);
    }
}
