<div class="flex flex-wrap">
    @foreach ($modifiers as $modifier)
        @if (isset($modifier['name_select']))
            <div class="flex flex-row">
                <h2 class="text-zinc-200 m-2">{{ $modifier['name_select'] }}</h2>
                <h2 class="text-zinc-200 m-2">{{ $modifier['position_select'] }}</h2>
            </div>
        @endif  
    @endforeach
</div>
<form method="GET" action="{{ route('clear_position_modifiers') }}">
    <x-primary-button type="submit">
        Remove all position modifiers
    </x-primary-button>
</form>