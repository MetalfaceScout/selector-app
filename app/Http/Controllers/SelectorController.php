<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PlayerPoolController;
use App\Models\LfstatsCenter;
use App\Models\LfstatsPlayerName;
use App\Models\LfstatsScorecard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

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
            if (isset($last_center_id->first()->center_id)) {
                $last_center = LfstatsCenter::where('id', '=', $last_center_id->first()->center_id)->get();
                $player->last_center_name = Str::upper($last_center->first()->short_name);
            } else {
                $player->last_center_name = "Unknown";
            }
            
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
    
    public function add_new_player_to_pool(Request $request) {
        $this->PlayerPoolController->add_newbie($request->name);
        $player_pool = $this->PlayerPoolController->get();

        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }

    public function select(Request $request) {

        $player_pool = $this->PlayerPoolController->get();

        $mode = "";

        switch ($request['mode_selection']) {
            case '10_players':
                $mode = 'sm5-10-player';
                break;
            case '12_players':
                $mode = 'sm5-12-player';
                break;
            case '8_players_queen_bee':
                $mode = 'sm5-queen-bee';
                break;
            case '14_players':
                $mode = 'sm5-14-player';
                break;
            default:
                $mode = 'sm5-12-player';
                break;
        }

        $process = [
            '/usr/local/bin/selector-backend'
        ];

        $process_c = collect($process);
        $pool_c = collect($player_pool);

        $pool_c->each(function ($item) use ($process_c) {
            if (isset($item['newbie'])) {
                $process_c->push("-n");
                $process_c->push($item['player_name']);
            } else {
                $process_c->push("-p");
                $process_c->push($item['id']);
            }
        });

        $process_c->push("--game-type");
        $process_c->push($mode);
        
        $modifiers = collect(Session::get("modifiers"));
        $modifiers->each(function ($modifier) use ($process_c) {
            if ($modifier['newbie'] == true) {
                $process_c->push('--modifier-position-new');
                $process_c->push($modifier['player_name']);
                $process_c->push($modifier['position_select']);
            } else {
                $process_c->push('--modifier-position');
                $process_c->push($modifier['name_select']);
                $process_c->push($modifier['position_select']);
            }
        });
            
        $team_result = Process::run($process_c->toArray());
        $output_data = json_decode($team_result->output());

        if ($team_result->errorOutput() == "" && !(isset($output_data)) ) {
            return view('results', [
                'results' => $output_data,
                'error' => "Failed to parse JSON from backend - Contact Metalface if you're seeing this.",
            ]);
        }

        return view('results', [
            'results' => $output_data,
            'error' => $team_result->errorOutput(),
        ]);
    }

    public function add_position_modifier(Request $request) {
        $player_pool = $this->PlayerPoolController->get();

        $modifier = $request->all();

        $modifiers = Session::get("modifiers", []);
        $player_name_ar = array_filter($player_pool,function($player) use ($modifier) {
            if ($player['id'] == $modifier['name_select']) {
                return true;
            }
            return false;
        });
        $modifier['player_name'] = reset($player_name_ar)->player_name;

        if (isset(reset($player_name_ar)->newbie)) {
            $modifier['newbie'] = true;
        }

        switch ($modifier['position_select']) {
            case "0":
                $modifier["player_position"] = "Commander";
                break;
            case "1":
                $modifier["player_position"] = "Heavy Weapons";
                break;
            case "2":
                $modifier["player_position"] = "Scout";
                break;
            case "3":
                $modifier["player_position"] = "Ammo Carrier";
                break;
            case "4":
                $modifier["player_position"] = "Medic";
                break;
            default:
                $modifier["player_position"] = "Unknown?";
        }
        
        array_push($modifiers, $modifier);
        Session::put("modifiers", $modifiers);

        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }

    public function clear_position_modifiers() {
        $player_pool = $this->PlayerPoolController->get();
        Session::forget("modifiers");
        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }

    public function remove_position_modifier(Request $request, $player_id) {
        $player_pool = $this->PlayerPoolController->get();

        $modifiers = Session::get("modifiers");
        $modifiers = array_filter($modifiers, function ($modifier) use ($player_id) {
            return $modifier['name_select'] != $player_id;
        });
        Session::put("modifiers", $modifiers);
        return view('selector', ['search_player' => [], 'player_pool' => $player_pool]);
    }
}