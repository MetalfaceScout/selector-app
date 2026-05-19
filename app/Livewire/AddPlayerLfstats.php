<?php

namespace App\Livewire;

use Livewire\Component;
use \Cache;
use \Http;
use Livewire\Attributes\Computed;

class AddPlayerLfstats extends Component
{

    public $centers = [];
    public $codename = '';
    public function render()
    {
        return view('livewire.add-player-lfstats');
    }

    public function __construct() {
        $this->centers = \App\Models\Center::all()->keyBy('center_id');
    }

    #[Computed]
    public function centerId() {
        $userCenter = auth()->user()->center;
        return $userCenter !== null ? $userCenter : 0;
    }

    #[Computed]
    public function players()
    {

        if (strlen($this->codename) < 2) return [];

        $allPlayers = Cache::remember('all_players_data_' . $this->centerId, 60*6, function () {
            $response = Http::get('https://lfstats.com/scorecards/getOverallAverages.json', [
                'gametype' => 'social',
                'centerID' => $this->centerId,
            ]);
            
            return $response->json()['data'] ?? collect();
        });

        return collect($allPlayers)
            ->filter(function ($item) {
                return str_contains(
                    strtolower($item['player_name']), 
                    strtolower($this->codename)
                );
            })
        ->take(7);

    }

    public function updateCenter($centerId) {
        $user = auth()->user();
        $user->center = $centerId;
        $user->save();
    }

    public function addPlayerFromLfstats($playerId)
    {
        $player = collect($this->players())->firstWhere('player_id', $playerId);
        
        if ($player) {
            $newPlayer = new \App\Models\Player();
            $newPlayer->codename = $player['player_name'];
            $newPlayer->user_id = auth()->id();
            $newPlayer->zone = 'player-pool';
            $newPlayer->lfstats_id = $player['player_id'];
            $newPlayer->commander_mvp = $player['commander_avg_mvp'] ?? 0;
            $newPlayer->heavy_mvp = $player['heavy_avg_mvp'] ?? 0;
            $newPlayer->scout_mvp = $player['scout_avg_mvp'] ?? 0;
            $newPlayer->ammo_mvp = $player['ammo_avg_mvp'] ?? 0;
            $newPlayer->medic_mvp = $player['medic_avg_mvp'] ?? 0;
            $newPlayer->center = $this->centerId;
            $newPlayer->save();
            $this->codename = '';
            $this->dispatch('player-moved');
        }
    }
}
