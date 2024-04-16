<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($player->codename) }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('players.update') }}">
        
    </form>

</x-app-layout>