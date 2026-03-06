<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <livewire:add-player />
        </x-slot>
        <x-slot name="middle">
            <livewire:player-zone zone-name="Player Pool" zone-id="player-pool" />
        </x-slot>
        <x-slot name="right">
            <livewire:team-board />
        </x-slot>
    </x-selector-layout>    
</x-app-layout>