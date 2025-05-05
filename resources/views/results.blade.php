<x-app-layout>
    <div class="flex flex-col">
        @if ($error != "")
            <h1>
                Error: {{ $error }}
            </h1>
        @else
            <div class="flex flex-wrap justify-center content-center">
            @foreach ($results as $team)
                <div class="flex-col">
                    <div class="flex justify-between border-double border-2">
                        <p class="my-4 mx-9 font-bold text-4xl">Player</p>
                        <p class="my-4 mx-9 font-bold text-4xl">Position</p>
                        <p class="my-4 mx-9 font-bold text-4xl">SMVP</p>
                    </div>
                    @foreach ($team as $player)
                        <div class="flex justify-between border-double border-2">
                            <h class="my-4 mx-9 text-2xl">{{ $player->player_name }}</h>
                            <h class="my-4 mx-9 text-2xl">{{ $player->position_pretty }}</h>
                            <h class="my-4 mx-9 text-2xl">{{ number_format($player->smvp, 1) }}</h>
                        </div>
                    @endforeach
                </div>
            @endforeach
            </div>
        @endif
    </d>
</x-app-layout>