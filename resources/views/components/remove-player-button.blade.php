@props(['id' => 0]) 

<form class="m-1 p-3 bg-zinc-900 shadow-md flex" method="POST" action="{{ route('remove_player_from_pool', ['id' => $id]) }}">
    @csrf
    <x-primary-button type="submit">
        Remove
    </x-primary-button>
</form>