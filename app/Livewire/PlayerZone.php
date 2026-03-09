<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Player;
use App\Livewire\Traits\ManagesPlayers;
use Auth;


// Base class
class PlayerZone extends Component
{
    use ManagesPlayers;

    public $zoneId;
    public $zoneName;
    public $players = [];

    public function mount($zoneName, $zoneId)
    {
        $this->zoneId = $zoneId;
        $this->zoneName = $zoneName;
        $this->loadPlayers();
    }

    #[On('player-moved')]
    public function loadPlayers()
    {
        // Logic to load players into the zone
        $this->players = Player::where(
            'zone', $this->zoneId)
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    public function handleDrop($playerId) {
        // Logic to handle player drop into the zone
        $player = Player::find($playerId);

        if ($player && ($player->zone !== $this->zoneId)) {
            
            $player->update(['zone' => $this->zoneId]);

        }

        $this->dispatch('player-moved');

        $this->loadPlayers();
    }


    public function render()
    {
        return view('livewire.player-zone');
    }
}
