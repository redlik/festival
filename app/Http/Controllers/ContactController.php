<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function contactFormSent(Request $request)
    {
        Mail::send('email.contact', ['request' => $request], function ($m) use ($request) {
            $m->from('admin@kerrymentalhealthandwellbeingfest.com', $request->name);
            $m->replyTo($request->email, $request->name);
            $m->to('admin@kerrymentalhealthandwellbeingfest.com', 'Kerry Fest Admins')
                ->subject('Contact form query');
        });
        Log::info('The email from '.$request->email.' has been sent.');
        $request->session()->flash('status', 'Thank you for contacting us, we will respond to the enquiry as soon as we can!');

        return back();
    }
}
