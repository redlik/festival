<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use App\Models\User;
use App\Notifications\AccountApproved;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrganiserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisers = Organiser::all();

        return view('organiser.index', compact('organisers'));
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
        if($request->input('hear_about') == 'Other') {
            $hear = $request->input('other');
        } else {
            $hear = $request->input('hear_about');
        }

        $slug = rand(1001,9999)."-".Str::of($request->input('name'))->slug('-');
        $organiser = Organiser::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'email' => $request->input('email'),
            'org' => $request->input('org'),
            'phone' => $request->input('phone'),
            'hear_about' => $hear,
            'address1' => $request->input('address1'),
            'street' => $request->input('street'),
            'town' => $request->input('town'),
            'county' => $request->input('county'),
            'eircode' => strtoupper($request->input('eircode')),
            'website' => $request->input('website'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'events' => $request->input('events'),
        ]);

        $admin = User::where('email', 'admin@kerryfest.com')->first();

        $admin->notify(new ApplicationSubmitted($organiser));

        return view('organiser.submitted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\Response
     */
    public function show(Organiser $organiser)
    {
        return view('organiser.show', compact('organiser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Organiser $organiser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organiser $organiser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organiser $organiser)
    {
        //
    }

    public function approved(Organiser $organiser, Request $request)
    {
        $organiser->update(['status' => 'approved']);

        $request->session()->flash('approved', $organiser->name . ' successfully approved.');

        $organiser->notify(new AccountApproved($organiser));

        return redirect()->route('organiser.index');
    }

    public function disabled(Organiser $organiser)
    {
        $organiser->update(['status' => 'disabled']);

        return back();
    }
}
