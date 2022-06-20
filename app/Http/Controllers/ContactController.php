<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactFormSent(Request $request)
    {
        Mail::send('email.contact', ['request' => $request], function ($m) use ($request) {

            $m->from($request->email, $request->name);

            $m->to('redlich.rafal@gmail.com', 'Kerry Fest Admins')
                ->subject('Contact form query');

        });

        $request->session()->flash('status', 'Thank you for contacting us, we will respond to the eqnuiry as soon as we can!');

        return back();
    }
}
