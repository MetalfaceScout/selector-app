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

        $duplicate = false;

        for ($i = 0; $i < count($player_pool); $i++) {
            if ($player_pool[$i]->id == $id) {
                $duplicate = true;
            }
        }
        
        if ($duplicate) {
            return false;
        }

        $player_pool[] = $player;
        Session::put("player_pool", $player_pool);

        return true;
    
    }

    public function remove($id) {
        $player_pool = Session::get("player_pool", []);

        if (empty($player_pool)) {
            return false;
        }

        for ($i = 0; $i < count($player_pool); $i++) {
            if ($player_pool[$i]->id == $id) {
                unset($player_pool[$i]);
                $player_pool = array_values($player_pool);
                Session::put("player_pool", $player_pool);
                return true;
            }
        }
        return false;
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

        return $player_pool;
    }
}
