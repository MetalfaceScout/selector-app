<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <x-player-chooser>
            </x-player-chooser>
            @isset($search_player)
                <div id="source-player-list" class="space-y-2"> 
                    @foreach ($search_player as $player)
                    <div class="player-card-item flex w-fit border rounded-sm sm:flex-row md:flex-col lg:flex-row cursor-move" 
                         data-id="{{ $player['id'] }}">
                        
                        <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}"/>
                        <x-add-player-button id="{{ $player['id'] }}"/>
                    </div>
                    @endforeach
                </div>
            @endisset
            <div id="source-player-list" class="space-y-2"> 
                <div class="player-card-item flex w-fit border rounded-sm sm:flex-row md:flex-col lg:flex-row cursor-move" 
                    data-id="0">
                            
                    <x-player-card codename="Sample Codename" last_center_name="SMP"/>
                    <x-add-player-button id="0"/>
                </div>
            </div>  

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
            <div id="player-pool-list">
                
            </div>
            <x-selector-submit/>
        </x-slot>
    </x-selector-layout>
</x-app-layout>
