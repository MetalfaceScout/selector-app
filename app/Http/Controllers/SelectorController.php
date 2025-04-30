<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PlayerPoolController;
use App\Models\LfstatsCenter;
use App\Models\LfstatsPlayerName;
use App\Models\LfstatsScorecard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

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
        $players = LfstatsPlayerName::where("player_name", "ilike", '%'. $playerName . '%')->take(5)->get();

        foreach ($players as $player) {

            $last_center_id = LfstatsScorecard::where("player_id", '=' , $player->id)->latest('created')->take(1)->get();
            $last_center = LfstatsCenter::where('id', '=', $last_center_id->first()->center_id)->get();
            
            $player->last_center_name = Str::upper($last_center->first()->short_name);
        }

        return view('selector', ['search_player' => $players->toArray(), 'player_pool' => $player_pool]);
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
    
    public function add_new_player_to_pool(Request $request, $name) {
        $this->PlayerPoolController->add_newbie($name );
    }

    public function remove_new_player_from_pool(Request $request, $name) {
        $this->PlayerPoolController->remove_newbie($name);
    }

    public function select(Request $request) {

        $player_pool = $this->PlayerPoolController->get();

        $process = [
            '/usr/local/bin/selector-backend'
        ];

        $process_c = collect($process);

        $pool_c = collect($player_pool);

        $pool_c->each( fn($item) => 
            $process_c->push("-p" . $item['id'])
        );

        /* $args_c = collect($args);
        $args_c->each( fn($item) =>
            $process_c->push($item)
        );
        
        dd($process_c); */
    
        $team_result = Process::run($process_c->toArray());

        $team_1 = [];
        $team_2 = [];

        $output_data = json_decode($team_result->output());

        dd($output_data, $team_result->errorOutput());

        return view('results', [
            'team_1' => $team_1,
            'team_2' => $team_2,
            'error' => $team_result->errorOutput(),
        ]);
    }
}
