<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LfstatsScorecard;
use App\Models\LfstatsCenter;
use Illuminate\Support\Str;


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

        $last_center_id = LfstatsScorecard::where("player_id", '=' , $player->id)->latest('created')->take(1)->get();
        $last_center = LfstatsCenter::where('id', '=', $last_center_id->first()->center_id)->get();
        $player->last_center_name = Str::upper($last_center->first()->short_name);

        $player_pool[] = $player;
        Session::put("player_pool", $player_pool);

        return true;
    
    }

    public function add_newbie($name) {
        $player_pool_newbie = Session::get("player_pool_newbie", []);

        $duplicate = false;

        for ($i = 0; $i < count($player_pool_newbie); $i++) {
            if ($player_pool_newbie[$i] == $name) {
                $duplicate = true;
            }
        }
        
        if ($duplicate) {
            return false;
        }

        $player_pool_newbie[] = $name;
        Session::put("player_pool_newbie", $player_pool_newbie);

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

    public function remove_newbie($name) {
        $player_pool = Session::get("player_pool_newbie", []);

        if (empty($player_pool)) {
            return false;
        }

        for ($i = 0; $i < count($player_pool); $i++) {
            if ($player_pool[$i] == $name) {
                unset($player_pool[$i]);
                $player_pool = array_values($player_pool);
                Session::put("player_pool_newbie", $player_pool);
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

    public function get_newbie() {
        if (Auth::user()) {
            ddd("IMPLEMENT THIS!");
        } else {
            $player_pool = Session::get("player_pool_newbie");
        }

        if (empty($player_pool)) {
            $player_pool = [];
        }

        return $player_pool;
    }
}
