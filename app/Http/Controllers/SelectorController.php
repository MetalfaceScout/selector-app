<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SelectorController extends Controller
{
    // Returns the view with all required data.
    public function get(Request $request){

        return view('selector');
    }

    public function getGuest(Request $request) {
        $user = User::create([
            'name' => 'Guest ' . Str::random(5),
            'email' => Str::random(10) . '@example.com',
            'password' => bcrypt(Str::random(16)),
            'temp' => true,
            'gametype' => 'sm5-6v6',
        ]);

        Auth::login($user);

        return view('selector');
    }

}