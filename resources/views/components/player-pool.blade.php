@props(['playerpool' => []])

<h1 class="dark:text-zinc-200 text-3xl p-4">Player Pool</h1>

<div class="flex flex-row flex-wrap border-zinc-600">
    @if ($playerpool == [])
    <p class="dark:text-red-400">The pool is empty! Search for a player to get started!</p>
    @endif
    @foreach ($playerpool as $player)
    <div class="border rounded-md flex flex-row justify-content">
        <x-player-card codename="{{ $player['player_name'] }}" last_center_name="{{ $player['last_center_name'] }}">
        </x-player-card>
        <x-remove-player-button id="{{ $player['id'] }}" />
    </div>
    @endforeach 
</div>