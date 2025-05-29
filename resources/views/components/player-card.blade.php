@props(['codename' => 'Default Codename', 'last_center_name' => ''])

<div class="border rounded-lg dark:border-gray-500 m-2 p-2 dark:text-zinc-50 dark:bg-zinc-900 shadow-md w-auto flex justify-center items-center">
    <h1 class="dark:text-zinc-50 text-2xl w-auto m-2">{{ __($codename) }}</h1>
    <p class="dark:text-zinc-50 text-right text-xs">{{ __($last_center_name) }}</p>
</div>