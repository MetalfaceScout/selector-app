<div
    @dragover.prevent

    @drop.prevent="
        let playerId = $event.dataTransfer.getData('text/plain');
        $wire.handleDrop(playerId);
    "
    class="h-1/2 border-2 border-dashed rounded-lg dark:border-zinc-600"
>
    {{-- The whole world belongs to you. --}}
    <h3 class="dark:text-zinc-100">
        {{ $zoneName }}
    </h3>

    <div class="flex flex-wrap justify-evenly items-center gap-y-2">
        @foreach($players as $player)
            <x-player-card :player="$player" />
        @endforeach
    </div>
</div>
