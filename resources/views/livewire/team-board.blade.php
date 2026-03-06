<div>
    {{-- The whole world belongs to you. --}}
    <div class="flex flex-row">
        @foreach($teamConfigs[$gameType] as $teamKey => $teamData)
            <div>
                <h4 class="mb-4 text-xl font-bold border-b-2">
                    {{ $teamKey }}
                </h4>
                @foreach ($teamData as $slotarray)
                    {{ $slotarray['position'] }}
                    @php
                        dd($players);
                    @endphp
                    <div
                        class="h-24 p-2 border-2 border-dashed rounded-lg flex items-center justify-center relative"

                        @dragover.prevent
                        
                        {{-- 2. Use @drop.prevent instead of ondrop --}}
                        @drop.prevent="
                            let playerId = $event.dataTransfer.getData('text/plain');
                            
                            $wire.handleSlotDrop(playerId, '{{ $loop->index }}', '{{ $teamKey }}');
                        "
                    >
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
