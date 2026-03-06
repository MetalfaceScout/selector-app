<div>
    {{-- The whole world belongs to you. --}}
    <div class="flex flex-row">
        @foreach ($teamConfigs[$gameType] as $team)
            <div>
                @foreach ($team as $slot)
                    {{ $slot['position'] }}
                    
                @endforeach
            </div>
        @endforeach
    </div>
</div>
