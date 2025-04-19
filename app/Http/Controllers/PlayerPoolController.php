<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PlayerPoolController extends Controller
{
    public function add($id) {

        $player = \App\Models\LfstatsPlayer::find($id);
        $player_pool = Session::get("player_pool", []);
        $player_pool[] = $player;
        Session::put("player_pool", $player_pool);

        return view('selector', ['player_pool' => $player_pool]);
    
    }

    public function get() {
        if (Auth::user()) {
            ddd("IMPLEMENT THIS!");
        } else {
            $player_pool = Session::get("player_pool");
        }

        if (empty($player_pool)) {
            $player_pool = [];
        }

        return view('selector', ['player_pool' => $player_pool]);
    }

}
