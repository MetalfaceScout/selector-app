<x-app-layout>
    <div class="flex flex-col">
        @if ($error != "")
            <h1 class="text-red-500 text-4xl m-12">
                Error: {{ $error }}
            </h1>
        @else
            <div class="flex flex-wrap justify-center content-center">
            @foreach ($results->teams as $team)
                <div class="flex-col">
                    <div class="flex justify-between border-double border-2">
                        <p class="my-4 mx-9 font-bold dark:text-zinc-100 text-4xl">Player</p>
                        <p class="my-4 mx-9 font-bold dark:text-zinc-100 text-4xl">Position</p>
                        <p class="my-4 mx-9 font-bold dark:text-zinc-100 text-4xl">MVP</p>
                    </div>
                    @foreach ($team as $player)
                        <div class="flex justify-between border-double border-2">
                            <h class="my-4 mx-9 dark:text-zinc-100 text-2xl">{{ $player->player_name }}</h>
                            <h class="my-4 mx-9 dark:text-zinc-100 text-2xl">{{ $player->position_pretty }}</h>
                            <h class="my-4 mx-9 dark:text-zinc-100 text-2xl">{{ number_format($player->smvp, 1) }}</h>
                        </div>
                    @endforeach
                    <div class="flex justify-between border-double border-2">
                        <p class="w-full text-center my-4 mx-9 font-bold dark:text-zinc-100 text-2xl">Team Average MVP: {{ number_format($results->totals[$loop->index], 1) }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>
</x-app-layout>