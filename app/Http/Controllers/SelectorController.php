<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PlayerPoolController;
use App\Models\LfstatsPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

class SelectorController extends Controller
{
    // Returns the view with all required data.

    protected $PlayerPoolController;

    public function __construct(PlayerPoolController $PlayerPoolController){
        $this->PlayerPoolController = $PlayerPoolController;
    }

    public function get(Request $request){

        $player_pool = $this->PlayerPoolController->get();

        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }

    // Search for a player.
    public function search_player(Request $request) {

        $player_pool = $this->PlayerPoolController->get();

        $playerName = $request->input('codename');
        $players = LfstatsPlayer::where("player_name", "ilike", '%'. $playerName . '%')->take(15)->get()->toArray();
        
        return view('selector', ['search_player' => $players, 'player_pool' => $player_pool]);
    }

    public function add_player_to_pool(Request $request, $player_id) {
        $this->PlayerPoolController->add( $player_id );
        $player_pool = $this->PlayerPoolController->get();

        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }

    public function remove_player_from_pool(Request $request, $id) {
        $this->PlayerPoolController->remove( $id );
        $player_pool = $this->PlayerPoolController->get();

        return view('selector', ['search_player' => [], 'player_pool'=> $player_pool]);
    }

    public function select(Request $request) {
        $player_pool = $this->PlayerPoolController->get();

        $all = $request->all();



        $team_result = Process::path(base_path())->run('selector-backend/target/debug/selector-backend');

        dd($team_result->errorOutput());

        return view('results', ['team_1' => $team_1, 'team_2' => $team_2]);
    }
}
