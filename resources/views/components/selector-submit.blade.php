<div>
    <form class='flex flex-wrap' method="GET" action="{{ route('send_selection') }}">
        <div>
            <x-input-label for="mode_selection">Selection Mode</x-input-label>
            <select name="mode_selection" id="mode_selection">
                <option value="12_players" {{ $position_select == '12_players' ? 'selected' : '' }}>12 Players</option>
                <option value="10_players" {{ $position_select == '10_players' ? 'selected' : '' }}>10 Players</option>
                <option value="8_players_queen_bee" {{ $position_select == '8_players_queen_bee' ? 'selected' : '' }}>Queen Bee</option>
                <option value="14_players" {{ $position_select == '14_players' ? 'selected' : '' }}>14 Players</option>
            </select>
        </div>
        <x-center-chooser>

        </x-center-chooser>
        <div>
            <x-input-label for="algorithm_selection">Selection Algorithm</x-input-label>
            <select name="algorithm_selection">
                <option value="advanced-selection"{{ $algorithm_select == 'advanced-selection' ? 'selected' : '' }}>Advanced Selection</option> 
                <option value="random-random"{{ $algorithm_select == 'random-random' ? 'selected' : '' }}>Random-Random</option>
            </select>

            <x-primary-button type="submit">Send Selection</x-primary-button>
        </div>
    </form>
</div>