<?php

namespace App\Livewire\Traits;

use App\Models\Player;

trait ManagesPlayers
{
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
        
    }

    public function removePlayer($playerId) {
        $player = Player::find($playerId);
        $player->delete();
        $this->dispatch('player-moved');
    }
}