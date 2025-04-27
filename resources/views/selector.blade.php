<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
            </x-player-chooser>
            @isset($search_player)
                @foreach ($search_player as $player)
                <div class="flex border rounded-sm">
                    <x-player-card codename="{{ $player['player_name'] }}"/>
                    <x-add-player-button id="{{ $player['id'] }}"/>
                </div>
                @endforeach
            @endisset
        </x-slot>
        <x-slot name="right">
            <x-player-pool :playerpool=$player_pool>
                
            </x-player-pool>
            <div>
                <form method="POST" action="{{ route('send_selection') }}">
                    <label for="mode_selection">Selection Mode</label>
                    <select name="mode_selection" id="mode_selection">
                        <option value="12_players">12 Players</option>
                        <option value="10_players">10 Players</option>
                        <option value="8_players_queen_bee">Queen Bee</option>
                        <option value="14_players">14 Players</option>
                    </select>
                </form>
            </div>
        </x-slot>
    </x-selector-layout>
</x-app-layout>