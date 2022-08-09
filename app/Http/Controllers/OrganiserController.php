<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use App\Models\User;
use App\Notifications\AccountActivation;
use App\Notifications\AccountApproved;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganiserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('show', 'index', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(403);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminIndex()
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
        return view('organiser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:organisers',
        ], [
            'email.unique' => 'Organiser with this email already exists',
        ]);

        if ($validator->fails()) {
            return redirect('/join-us')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('hear_about') == 'Other') {
            $hear = $request->input('other');
        } else {
            $hear = $request->input('hear_about');
        }

        $slug = rand(1001, 9999).'-'.Str::of($request->input('name'))->slug('-');
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
            'linkedin' => $request->input('linkedin'),
            'events' => $request->input('events'),
            'garda_vetting' => $request->input('garda_vetting'),
        ]);

        $organiser->notify(new AccountActivation($organiser));

        $admin = User::where('email', 'admin@kerrymentalhealthandwellbeingfest.com')->first();
        $admin->notify(new ApplicationSubmitted($organiser));

        return view('organiser.submitted', compact('organiser'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Organiser $organiser)
    {
        return view('organiser.edit', compact('organiser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Organiser $organiser)
    {
        $organiser->update($request->all());

        return back()->with('profile_updated', 'Your profile information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organiser  $organiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organiser $organiser)
    {
        $message = 'Organiser '.$organiser->org.' has been deleted';
        $organiser->delete();

        return back()->with('deleted', $message);
    }

    public function approved(Organiser $organiser, Request $request)
    {
        $organiser->update(['status' => 'activated']);

        $request->session()->flash('approved', $organiser->name.' successfully approved.');

//        $organiser->notify(new AccountApproved($organiser));

        return redirect()->route('organiser.index');
    }

    public function disabled(Organiser $organiser)
    {
        $organiser->update(['status' => 'disabled']);

        return back();
    }

    public function resendActivation(Organiser $organiser)
    {
        $organiser->notify(new AccountActivation($organiser));
        $message = 'Activation email sent to '.$organiser->email;

        return back()->with('resend', $message);
    }
}
