<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;
use Auth;

class AddPlayer extends Component
{
    public $codename = '';

    public function savePlayer()
    {
        $this->validate([
            'codename' => 'required|string|max:15|min:3',
        ]);

        Player::create([
            'codename' => $this->codename,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset('codename');

        $this->dispatch('player-moved');
    }

    public function render()
    {
        return view('livewire.add-player');
    }
}
