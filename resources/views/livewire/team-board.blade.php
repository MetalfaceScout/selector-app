<div>
    {{-- The whole world belongs to you. --}}
    <div class="flex flex-row">
        @foreach($teamConfigs[$this->gameType] as $teamKey => $teamData)
            
            <div>
                <h4 class="mb-4 text-xl font-bold border-b-2 dark:text-zinc-200">
                    {{ $teamKey }}
                </h4>
                @foreach ($teamData as $slotarray)
                    @php
                        try {
                            $team = $players[$teamKey];
                            $playerInSlot = $team->first(function ($val, $key) use ($slotarray) {
                                return (int)$val->slot == (int)$slotarray['id'];
                            }); 
                        } catch (\Throwable $th) {
                            $playerInSlot = null;
                        }
                    @endphp
                    <div
                        class="h-24 p-4 my-3 mx-1 border-zinc-500 border-2 border-dashed rounded-lg flex space-x-1 items-center justify-center relative"
                        @dragover.prevent
                        @drop.prevent="
                            let playerId = $event.dataTransfer.getData('text/plain');
                            $wire.handleSlotDrop(playerId, '{{ $loop->index }}', '{{ $teamKey }}');
                        "
                    >
                        @if($playerInSlot)
                            <img 
                            @dragstart.prevent
                            class="h-4 sm:h-8 md:h-16 lg:h-4 xl:h-12" src="{{ $slotarray['icon'] }}"/>
                            <x-player-card :player="$playerInSlot"></x-player-card>
                        @else
                            <img
                            @dragstart.prevent
                            class="h-16" src="{{ $slotarray['icon'] }}"/>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
