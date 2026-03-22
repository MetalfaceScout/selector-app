<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Traits\ManagesPlayers;

class ChangeGametype extends Component
{
    use ManagesPlayers;

    public function render()
    {
        return view('livewire.change-gametype');
    }

    public function changeGametype($gametype) {
        $user = auth()->user();
        $user->gametype = $gametype;
        $user->save();
        $this->returnAllToPool(0);
        $this->dispatch('player-moved');
    }
}
