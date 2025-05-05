@props(['codename' => 'Default Codename', 'last_center_name' => ''])

<div class="border rounded-lg border-gray-500 m-2 p-2 bg-zinc-900 shadow-md w-full flex justify-between">
    <h1 class="text-zinc-50 text-2xl">{{ __($codename) }}</h1>
    <p class="text-zinc-50">Last Center: {{ __($last_center_name) }}</p>
</div>