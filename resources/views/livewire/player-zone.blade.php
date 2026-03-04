<div
    ondragover="event.preventDefault()"
    ondrop="
        event.preventDefault();
        let playerId = event.dataTransfer.getData('text/plain');
        @this.call('handleDrop', playerId);
    "
>
    {{-- The whole world belongs to you. --}}
    <h3 class="dark:text-zinc-100">
        {{ $zoneName }}
    </h3>

    <div>
        @foreach($players as $player)
            <div wire:key="player-{{ $player->id }}">
                <x-player-card :player="$player" />
            </div>
        @endforeach
    </div>
</div>
