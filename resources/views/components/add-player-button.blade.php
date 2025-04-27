@props(['id' => 0]) 

<form class="m-4 p-4 bg-zinc-900 shadow-md flex" method="POST" action="{{ route('add_player_to_pool', ['id' => $id]) }}">
    @csrf
    <x-primary-button type="submit">
        Add
    </x-primary-button>
</form>
