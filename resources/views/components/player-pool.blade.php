@props(['playerpool' => []])

<div class="border border-zinc-600">
    @foreach ($playerpool as $player)
        <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}">

        </x-player-card>
        <x-remove-player-button id="{{ $player['id'] }}" />
    @endforeach
</div>