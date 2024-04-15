<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($player->codename) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="POST" action="{{ route()}}"
    </div>
</x-app-layout>