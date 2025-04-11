<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
                @foreach ($search_player as $player)
                    <x-player-card codename={{ $player->codename }}/>
                @endforeach
            </x-player-chooser>
        </x-slot>
        <x-slot name="right">
            Selector
        </x-slot>
    </x-selector-layout>
</x-app-layout>