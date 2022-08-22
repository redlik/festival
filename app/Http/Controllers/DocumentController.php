<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Event;
use Auth;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->orderBy('created_at', 'desc')->with('event')->get();
        $events = Event::where('user_id', Auth::id())->get();

        return view('document.index', compact('documents', 'events'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $document = Document::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
        ]);

        foreach ($request->input('events') as $event) {
            $document->event()->attach($event);
        }


        if ($request->hasFile('file')) {
            $document->addMediaFromRequest('file')
                ->toMediaCollection('docs');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->event()->detach();
        $document->delete();

        return back();
    }
}
