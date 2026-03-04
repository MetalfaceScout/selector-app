<?php

namespace App\Livewire;

use Livewire\Component;

class TeamBoard extends Component
{

    public $gameType = 'sm5-6v6';

    public $players = [];

    public $teamConfigs = 
    [
        'sm5-6v6' => [
            'red' => [
                0 => ['position' => 'Commander', 'icon' => 'path to icon'],
                1 => ['position' => 'Heavy', 'icon' => 'path to icon'],
                2 => ['position' => 'Scout', 'icon' => 'path to icon'],
                3 => ['position' => 'Scout', 'icon' => 'path to icon'],
                4 => ['position' => 'Ammo', 'icon' => 'path to icon'],
                5 => ['position' => 'Medic', 'icon' => 'path to icon'],
            ],
            'blue' => [
                0 => ['position' => 'Commander', 'icon' => 'path to icon'],
                1 => ['position' => 'Heavy', 'icon' => 'path to icon'],
                2 => ['position' => 'Scout', 'icon' => 'path to icon'],
                3 => ['position' => 'Scout', 'icon' => 'path to icon'],
                4 => ['position' => 'Ammo', 'icon' => 'path to icon'],
                5 => ['position' => 'Medic', 'icon' => 'path to icon'],
            ]
        ]
    ];

    #[On('player-moved')]
    public function loadPlayers()
    {
        $teams = array_keys($this->teamConfigs[$this->gameType]);

        $this->players = Player::whereIn('zone', $teams)
                            ->get()
                            ->groupBy('zone')
                            ->toArray(); 
    }

    public function handleSlotDrop($playerId, $targetSlot)
    {
        $playerIdAsInt = (Int) trim($playerId);
        $incomingPlayer = Player::find($playerIdAsInt);

        // Is there a player there?
        if ($incomingPlayer) {
            $existingPlayer = Player::where(
                'zone', $zoneId
            )->where(
                'slot', $targetSlot
            )->first();

            //Swap
            if ($existingPlayer) {
                $existingPlayer->slot = $incomingPlayer->slot;
                $existingPlayer->zone = $incomingPlayer->zone;
            }
        }
    }

    public function render()
    {
        return view('livewire.team-board');
    }
}

class Slot {

}
