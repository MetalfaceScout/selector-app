<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Attributes\On;
use Livewire\Component;
use Auth;

class TeamBoard extends Component
{

    public $gameType = 'sm5-6v6';

    public $players = [];

    public $teamConfigs = 
    [
        'sm5-6v6' => [
            'red' => [
                0 => ['id'=> 0, 'position' => 'Commander', 'icon' => 'icons/commander.svg'],
                1 => ['id'=> 1, 'position' => 'Heavy', 'icon' => 'icons/heavy.svg'],
                2 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                3 => ['id'=> 3, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                4 => ['id'=> 4, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                5 => ['id'=> 5, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ],
            'blue' => [
                0 => ['id'=> 0, 'position' => 'Commander', 'icon' => 'icons/commander.svg'],
                1 => ['id'=> 1, 'position' => 'Heavy', 'icon' => 'icons/heavy.svg'],
                2 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                3 => ['id'=> 3, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                4 => ['id'=> 4, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                5 => ['id'=> 5, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ]
        ],
        'sm5-5v5' => [
            'red' => [
                0 => ['id'=> 0, 'position' => 'Commander', 'icon' => 'icons/commander.svg'],
                1 => ['id'=> 1, 'position' => 'Heavy', 'icon' => 'icons/heavy.svg'],
                3 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                4 => ['id'=> 3, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                5 => ['id'=> 4, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ],
            'blue' => [
                0 => ['id'=> 0, 'position' => 'Commander', 'icon' => 'icons/commander.svg'],
                1 => ['id'=> 1, 'position' => 'Heavy', 'icon' => 'icons/heavy.svg'],
                3 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                4 => ['id'=> 3, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                5 => ['id'=> 4, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ]
        ],
    ];

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
