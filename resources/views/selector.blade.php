<x-app-layout>
    <x-selector-layout>
        <x-slot name="left">
            <livewire:add-player />
        </x-slot>
        <x-slot name="middle">
            <livewire:player-zone zone-name="Player Pool" zone-id="player-pool" />
            <livewire:player-zone zone-name="Bench" zone-id="bench" />
        </x-slot>
        <x-slot name="right">
            <div>
                <livewire:team-board />
                <livewire:matchmaker />
            </div>
        </x-slot>
    </x-selector-layout>    
</x-app-layout>