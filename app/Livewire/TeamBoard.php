<?php

namespace App\Livewire;

use App\Livewire\Traits\ManagesPlayers;
use App\Models\Player;
use Livewire\Attributes\On;
use Livewire\Component;
use Auth;

class TeamBoard extends Component
{
    use ManagesPlayers;
    public $players = [];

    public function mount() {
        $this->loadPlayers();
    }

    #[On('player-moved')]
    public function loadPlayers()
    {
        $teams = array_keys($this->teamConfigs[$this->gameType]);

        $this->players = Player::whereIn('zone', $teams)
                            ->where('user_id', Auth::user()->id)
                            ->get()
                            ->groupBy('zone')
                            ->map(function ($player) {
                                return $player->sortBy('slot')->values();
                            });
        
    }

    public function handleSlotDrop($playerId, $targetSlot, $targetZone)
    {
        $playerIdAsInt = (Int) trim($playerId);
        $incomingPlayer = Player::find($playerIdAsInt);

        // Is there a player there?
        if ($incomingPlayer) {
            $existingPlayer = Player::where(
                'zone', $targetZone 
            )->where(
                'slot', $targetSlot
            )->first();

            //Swap if existing player
            if ($existingPlayer) {
                $existingPlayer->slot = $incomingPlayer->slot;
                $existingPlayer->zone = $incomingPlayer->zone;
                $existingPlayer->save();
            }

        }

        if ($incomingPlayer) {
            // Move the player into the slot
            $incomingPlayer->slot = $targetSlot;
            $incomingPlayer->zone = $targetZone;
            $incomingPlayer->save();
        }

        
        $this->dispatch("player-moved");

        $this->loadPlayers();

    }

    

    public function render()
    {
        return view('livewire.team-board');
    }
}
