<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $events = Event::with('venue')->orderBy('start_date', 'asc')->get();

        return view('pages.home', compact('events'));
    }
}
