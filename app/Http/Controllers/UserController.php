<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function activate(Request $request)
    {
        $user = Organiser::find($request->get('account'));

        return view('user.registration', compact('user'));
    }


}
