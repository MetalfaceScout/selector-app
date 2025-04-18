<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
            </x-player-chooser>
            @isset($search_player)
                @foreach ($search_player as $player)
                    <x-player-card codename="{{ $player['player_name'] }}"/>
                @endforeach
            @endisset
        </x-slot>
        <x-slot name="right">
            <x-player-pool>
                
            </x-player-pool>
            Selector
        </x-slot>
    </x-selector-layout>
</x-app-layout>