@props(['codename' => 'Default Codename', 'id' => 0])

<div class="border rounded-lg border-gray-500 m-4 p-4 bg-zinc-900 shadow-md flex">
    <h1 class="text-zinc-50">{{ __($codename) }}</h1>
    <form method="POST" action="{{ route('add_player_to_pool', ['id' => $id]) }}">
        @csrf
        <x-primary-button type="submit">
            >>
        </x-primary-button>
    </form>
</div>