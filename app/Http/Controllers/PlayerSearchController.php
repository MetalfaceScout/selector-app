<?php

namespace App\Http\Controllers;

use App\Models\LfstatsPlayer;
use Illuminate\Http\Request;

class PlayerSearchController extends Controller
{
    public function search(Request $request) {

        $playerName = $request->input('codename');

        $players = LfstatsPlayer::where("player_name", "ilike", '%'+$playerName+'%');
        
        return view('selector', ['search_players' => $players]);

    }
}
