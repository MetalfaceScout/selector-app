<div
    ondragover="event.preventDefault()"
    ondrop="
        event.preventDefault();
        let playerId = event.dataTransfer.getData('text/plain');
        @this.call('handleDrop', playerId);
    "
>
    {{-- The whole world belongs to you. --}}
    <h3>
        {{ $zoneName }}
    </h3>

    <div>
        @foreach($players as $player)
            <div
                draggable="true"
                ondragstart="event.dataTransfer.setData('text/plain', '{{ $player->id }}')"
                class="p-2 border rounded mb-2 bg-white dark:bg-gray-800 dark:text-zinc-400"
                wire:key="player-{{ $player->id }}"
                >
                {{ $player->codename }}
            </div>
        @endforeach
    </div>
</div>
