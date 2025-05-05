<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
            </x-player-chooser>
            @isset($search_player)
                @foreach ($search_player as $player)
                <div class="flex border rounded-sm">
                    <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}"/>
                    <x-add-player-button id="{{ $player['id'] }}"/>
                </div>
                @endforeach
            @endisset
            <div class="p-2">
                <form method="GET" action="{{ route('add_new_player_to_pool') }}">
                    <x-input-label for="name" :value="__('Add New Player')" />
                    <x-text-input for="name" class="block mt-1 w-full"
                        type="text"
                        name="name"
                        required />
                    <x-primary-button type="submit">Add</x-primary-button>
                </form>
            </div>
            <form method="GET" action="{{ route('add_position_modifier') }}" class="flex flex-wrap">
                <div>
                    <x-input-label for="name_select" :value="__('Player')" />
                    <select name="name_select">
                        @foreach ($player_pool as $player)
                            <option value="{{ $player->id }}">{{ $player->player_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="position_select" :value="__('Position')" />
                    <select name="position_select">
                        <option value="0">Commander</option>
                        <option value="1">Heavy Weapons</option>
                        <option value="2">Scout</option>
                        <option value="3">Ammo Carrier</option>
                        <option value="4">Medic</option>
                    </select>
                </div>
                <x-primary-button type="submit">Add Modifier</x-primary-button>
            </form>
        </x-slot>
        <x-slot name="right">
            <x-player-pool :playerpool=$player_pool />
            <div>
                <form class='flex flex-wrap' method="GET" action="{{ route('send_selection') }}">
                    <div>
                        <x-input-label for="mode_selection">Selection Mode</x-input-label>
                        <select name="mode_selection" id="mode_selection">
                            <option value="12_players">12 Players</option>
                            <option value="10_players">10 Players</option>
                            <option value="8_players_queen_bee">Queen Bee</option>
                            <option value="14_players">14 Players</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="algorithm_selection">Selection Algorithm</x-input-label>
                        <select name="algorithm_selection">
                            <option value="advanced_selection">Advanced Selection</option>  
                        </select>

                        <x-primary-button type="submit">Send Selection</x-primary-button>
                    </div>
                </form>
            </div>
        </x-slot>
    </x-selector-layout>
</x-app-layout>