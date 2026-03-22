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


    public function matchmake() {

        // Get all players
        // Assign Modifiers
        // Fill best match based on assigned modifiers
        // Random select empty positions
        // Fill best match on last empty
        // Could be easier on python???
    
        $allTeams = array_keys($this->teamConfigs[$this->gameType]);

        $players = $this->returnAllToPool(0);
        
        // Assign modifiers - Grab modifier players until there are none left or we are unable to assign a modifier due to full slots

        // Grab all the players that have active modifiers -> then sort them based on that modifier.
        // Assign single choice positions first -> then multi choice starting with resup
        $playerArray = $players->where('modifier', '!=' ,'')
            ->sortBy(function ($player) {
                switch ($player->modifier) {
                    case 'commander':
                    case 'heavy':
                    case 'scout':
                    case 'ammo':
                    case 'medic':
                        return random_int(0,4);
                    case 'resupply':
                        return 5;
                    case '1hit':
                        return 6;
                    case '3hit':
                        return 7;
                }
        });

        while ($playerArray->count() > 0) {
            $player = $playerArray->first();
            $slots = collect($this->getModifierTable()[$player->modifier]);
            $slotFilled = false;
            while (!$slotFilled) {
                // Choose a slot from the array e.g. 3 hit -> [0, 1]
                try {
                    $chosenSlot = $slots->random();
                    $slots->forget($chosenSlot);
                } catch (\Throwable $th) {
                    // If we can't choose a slot that means that we've exhausted our options and we must return
                    $this->dispatch('show-error-toast', message: "Not enogh slots");
                    return;
                }

                // Get all the teams available

                $teams = collect($allTeams);
                // Any slots available based on filled slots? If there is a player, remove it from the list 
                $availableTeams = collect([]);
                foreach ($teams as $team) {
                    //Get all players on that team
                    $playersOnTeam = $players->where("zone", $team);
                    //Get player in the chosen slot
                    $playerInChosenSlot = $playersOnTeam->where("slot", $chosenSlot)->first();
                
                    if (!$playerInChosenSlot) {
                        $availableTeams->push($team);
                    }
                }
            
                // If we have a team here that means there is a free slot
                try {
                    $chosenTeam = $availableTeams->random();
                    // Assign that player to the slot we know is free
                    $player->slot = $chosenSlot;
                    $player->zone = $chosenTeam;
                    
                    $playerArray->forget($playerArray->search($player));

                    //TODO: Full batch database update
                    $player->save();

                } catch (\Throwable $th) {
                    //If there was no team then there wasn't a free slot, try the next one
                    continue;
                }

                $slotFilled = true;
            }
        }

        $slots = array_keys($this->teamConfigs[$this->gameType][array_key_first($this->teamConfigs[$this->gameType])]);
        $teamCount = count($allTeams);


        while ($this->teamIsFull($players) == false) {
            foreach ($slots as $slot) {
                $playersInSlot = $players->where('slot', $slot)->where('zone', '!=', 'player-pool');

                // Case 1: All teams empty for slot: Chose a random team and assign a random player from the pool to that slot
                if ($playersInSlot->count() == 0) {
                    $availableTeams = collect($allTeams);
                    $chosenTeam = $availableTeams->random();
                    $player = $players->where('zone', 'player-pool')->random();
                    $player->zone = $chosenTeam;
                    $player->slot = $slot;
                    $player->save();
                }

                // Case 2: One or more players on team in that slot but team is not full:
                if ($playersInSlot->count() > 0 && $playersInSlot->count() < $teamCount) {
                    $playerInSlot = $players->where('slot', $slot)
                        ->where('zone', '!=', 'player-pool')
                        ->first();
                    $positionalMvp = $playerInSlot->getMVPFromIndex($slot);
                    $matchedPlayer = $players
                        ->reject(fn($player) => $player->id === $playerInSlot->id)
                        ->reject(fn($player) => $player->zone != 'player-pool')
                        ->sortBy(function ($player) use ($positionalMvp, $slot) {
                            return abs($player->getMVPFromIndex($slot) - $positionalMvp);
                        })
                        ->first();
                    $remainingTeams = collect($allTeams)->reject(fn($team) => $team == $playerInSlot->zone);
                    $chosenTeam = $remainingTeams->random();
                    $matchedPlayer->zone = $chosenTeam;
                    $matchedPlayer->slot = $slot;
                    $matchedPlayer->save();
                }
                
            }
        }
        

        $this->dispatch('player-moved');
    }

    private function teamIsFull($players) {
        $count = 0;
        $teams = array_keys($this->teamConfigs[$this->gameType]);
        foreach ($teams as $team) {
            $playersOnTeam = $players->where('zone', $team);
            foreach ($playersOnTeam as $player) {
                $count += 1;
            }
        }

        if ($count < $this->getMinRequiredPlayers()) {
            return false;
        }
        return true;
    }

    private function matchMVP($positionalMVP, $players, $position) {
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
