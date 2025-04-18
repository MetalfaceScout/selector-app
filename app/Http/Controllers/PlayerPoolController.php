<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PlayerPoolController extends Controller
{
    public function add($request) {

        $player = \App\Models\LfstatsPlayer::get($request->id);

    }

    public function get() {
        if (Auth::user()) {
            ddd("IMPLEMENT THIS!");
        } else {
            $player_pool = Session::get("player_pool", []);
        }

        return view('selector', ['player_pool' => $player_pool]);
    }
}
