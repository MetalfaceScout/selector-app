@props(['id' => 0]) 

<form class="m-2 p-2 dark:bg-zinc-900 flex" method="POST" action="{{ route('add_player_to_pool', ['id' => $id]) }}">
    @csrf
    <x-primary-button type="submit">
        Add
    </x-primary-button>
</form>
