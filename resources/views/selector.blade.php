<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
            </x-player-chooser>
            @isset($search_player)
                @foreach ($search_player as $player)
                <div class="flex w-fit border rounded-sm sm:flex-row md:flex-col lg:flex-row">
                    <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}"/>
                    <x-add-player-button id="{{ $player['id'] }}"/>
                </div>
                @endforeach
            @endisset
            <div class="p-2">
                <form method="GET" action="{{ route('add_new_player_to_pool') }}">
                    <x-input-label for="name" :value="__('Add New Player')" />
                    <x-text-input for="name" class="mt-1 md:w-2/3 lg:w-auto"
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
            <x-modifiers>
                
            </x-modifiers>
        </x-slot>
        <x-slot name="right">
            <x-player-pool :playerpool=$player_pool />
            <x-selector-submit/>
        </x-slot>
    </x-selector-layout>
</x-app-layout>