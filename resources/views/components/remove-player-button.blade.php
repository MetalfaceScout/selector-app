@props(['id' => 0]) 

<form class="p-3 flex" method="POST" action="{{ route('remove_player_from_pool', ['id' => $id]) }}">
    @csrf
    <x-primary-button type="submit">
        Remove
    </x-primary-button>
</form>