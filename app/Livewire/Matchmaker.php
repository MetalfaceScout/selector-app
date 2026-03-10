<?php

namespace App\Livewire;

use App\Livewire\Traits\ManagesPlayers;
use App\Models\Player;
use Livewire\Component;
use Auth;

class Matchmaker extends Component
{
    use ManagesPlayers;
    public function render()
    {
        return view('livewire.matchmaker');
    }

    public function returnAllToPool(bool $reload) {
        $players = Player::where('user_id', Auth::user()->id)
        ->where('zone', '!=', 'bench')->get();

        $players->each(function ($player) {
            $player->zone = 'player-pool';
            $player->save();
        });

        if ($reload) {
            $this->dispatch('player-moved');
        }

        return $players;
    }

    public function matchmake() {
        $this->dispatch('show-error-toast', message: 'This feature is not ready yet!');
    }

    public function shuffle() {    
        
        $players = Player::where('user_id', Auth::user()->id)
        ->where('zone', '!=', 'bench')->get();
        
        if ($players->count() < $this->getMinRequiredPlayers()) {
            $this->dispatch('show-error-toast', message: 'There are not enough players!');
            return;
        }

        $players = $this->returnAllToPool(false);
        $players = $players->shuffle();
        
        foreach ($this->teamConfigs[$this->gameType] as $teamKey => $team) {
            foreach ($team as $slot) {
                $player = $players->shift();
                $player->zone = $teamKey;
                $player->slot = $slot['id'];
                $player->save();
            }
        }

        $this->dispatch('player-moved');
    }
}
