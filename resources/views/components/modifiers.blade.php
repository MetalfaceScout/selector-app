<div>
    @foreach ($modifiers as $modifier)
        @if (isset($modifier['name_select']))
            <div class="border-2 flex flex-row border-zinc-500">
                <h2 class="m-4 dark: text-zinc-200">{{ $modifier['player_name'] }}</h2>
                <h2 class="m-4 dark: text-zinc-200">{{ $modifier['player_position'] }}</h2>
                <form method="POST" action="{{ route('remove_position_modifier', ["player_id" => $modifier['name_select']]) }}">
                    @csrf
                    <x-primary-button class="m-4" type="submit">Remove Modifier</x-primary-button>
                </form>
            </div>
        @endif
    @endforeach
</div>