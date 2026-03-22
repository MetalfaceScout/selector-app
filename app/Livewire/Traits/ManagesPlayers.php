<?php

namespace App\Livewire\Traits;

use App\Models\Player;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

trait ManagesPlayers
{
    #[Computed]
    public function gameType() {
        return auth()->user()->gametype;
    }

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
                2 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                3 => ['id'=> 3, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                4 => ['id'=> 4, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ],
            'blue' => [
                0 => ['id'=> 0, 'position' => 'Commander', 'icon' => 'icons/commander.svg'],
                1 => ['id'=> 1, 'position' => 'Heavy', 'icon' => 'icons/heavy.svg'],
                2 => ['id'=> 2, 'position' => 'Scout', 'icon' => 'icons/scout.svg'],
                3 => ['id'=> 3, 'position' => 'Ammo', 'icon' => 'icons/ammo.svg'],
                4 => ['id'=> 4, 'position' => 'Medic', 'icon' => 'icons/medic.svg'],
            ]
        ],
    ];

    public function updateMvp(int $playerId, $commander, $heavy, $scout, $ammo, $medic) {
        $player = Player::find($playerId);
        $player->update(
            ['commander_mvp'=> $commander,
            'heavy_mvp'=> $heavy,
            'scout_mvp' => $scout,
            'ammo_mvp' => $ammo,
            'medic_mvp' => $medic
            ]);
    }

    public function updateFromLfstats($playerId, $newId) {
        $player = Player::find($playerId);
        //not implemented
        $this->dispatch('show-error-toast', message: 'This feature is not ready yet!');
    }

    public function removePlayer($playerId) {
        $player = Player::find($playerId);
        $player->delete();
        $this->dispatch('player-moved');
    }
    
    #[On('gametype-changed')]
    public function updateGameType($gameType) {
        $this->gameType = $gameType;
    }

    public function getMinRequiredPlayers() {
        $count = 0;
        foreach ($this->teamConfigs[$this->gameType] as $team) {
            $count += collect($team)->count();
        }
        return $count;
    }

    public function updateModifier($playerId, $modifier) {
        $player = Player::find($playerId);
        $player->modifier = $modifier;
        $player->save();
    }

    public function returnAllToPool(bool $reload) {
        $players = Player::where('user_id', auth()->user()->id)
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
}