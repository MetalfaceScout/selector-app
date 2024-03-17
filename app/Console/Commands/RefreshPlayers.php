<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 
        'https://lfstats.com/scorecards/getOverallAverages.json?' .
        'gametype=social&' .
        'centerID=' . '17' . '&' .
        'leagueID=0&' .
        'isComp=0&' .
        'date=2024-02-07&' .
        'show_rounds=true&' .
        'show_finals=false&' .
        'show_subs=true');
        $json = json_decode($response->getBody());
        foreach ($json->data as $player) {
            //dd($player);
            $playernew = \App\Models\Player::updateOrCreate(
                ['id' => $player->player_id,
                'codename' => $player->player_name,
                'link' => $player->player_name_link,
                'avg_mvp' => $player->avg_avg_mvp,
                'mvp_per_minute' => $player->mvp_per_minute,
                'avg_avg_acc' => $player->avg_avg_acc,
                'hit_diff' => $player->hit_diff,
                'games_won'=> $player->games_won,
                'games_played' => $player->games_played,
                'commander_avg_mvp' => $player->commander_avg_mvp,
                'commander_avg_acc'=> $player->commander_avg_acc,
                'heavy_avg_mvp' => $player->heavy_avg_mvp,
                'heavy_avg_acc' => $player->heavy_avg_acc,
                'scout_avg_mvp'=> $player->scout_avg_mvp,
                'scout_avg_acc' => $player->scout_avg_acc,
                'ammo_avg_mvp' => $player->ammo_avg_mvp,
                'ammo_avg_acc' => $player->ammo_avg_acc,
                'medic_avg_mvp' => $player->medic_avg_mvp,
                'medic_avg_acc'=> $player->medic_avg_acc
                ]
            );
        }
    }
}
