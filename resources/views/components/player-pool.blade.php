@props(['playerpool' => []])

<div class="border flex flex-row flex-wrap border-zinc-600">
    @foreach ($playerpool as $player)
    <div class="flex flex-row justify-content">
        <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}">
        </x-player-card>
        <x-remove-player-button id="{{ $player['id'] }}" />
    </div>
    @endforeach 
</div>