<div>
    @foreach ($modifiers as $modifier)
        @if (isset($modifier['name_select']))
            <h2>{{ $modifier['name_select'] }}</h2>
            <h2>{{ $modifier['position_select'] }}</h2>
        @endif
    @endforeach
</div>