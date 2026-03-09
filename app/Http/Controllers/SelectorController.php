<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SelectorController extends Controller
{
    // Returns the view with all required data.
    public function get(Request $request){

        return view('selector');
    }

    public function select(Request $request) {

        $player_pool = [];

        $mode = "";

        Session::put("position_select_last", $request['mode_selection']);
        Session::put("algorithm_select_last", $request['algorithm_selection']);
        Session::put("center_select_last", $request['center_select']);

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
            if (isset($modifier['newbie'])) {
                $process_c->push('--modifier-position-new');
                $process_c->push($modifier['player_name']);
                $process_c->push($modifier['position_select']);
            } else {
                $process_c->push('--modifier-position');
                $process_c->push($modifier['name_select']);
                $process_c->push($modifier['position_select']);
            }
        });

        $process_c->push("-c");
        $process_c->push($request->center_select);

        $process_c->push("-a");
        $process_c->push($request->algorithm_selection);
            
        $team_result = Process::run($process_c->toArray());
        $output_data = json_decode($team_result->output());

        if ($team_result->errorOutput() == "" && !isset($output_data) ) {
            return view('results', [
                'results' => $output_data,
                'error' => "Failed to parse JSON from backend - Contact Metalface if you're seeing this.",
            ]);
        }

        return view('results', [
            'results' => $output_data,
            'totals' => null,
            'error' => $team_result->errorOutput(),
        ]);
    }
}