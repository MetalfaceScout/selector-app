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
            $player = \App\Models\Player::updateOrCreate(
                ['id' => $player->id],
                ['name' => $player->name],
                ['player_name_link' => $player->link],
                ['avg_avg_mvp' => $player->avg_mvp],
                ['mvp_per_minute' => $player->mvp_minute],
                ['avg_avg_acc' => $player->accuracy]
            );
        }
    }
}
