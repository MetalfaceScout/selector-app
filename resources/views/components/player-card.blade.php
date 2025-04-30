@props(['codename' => 'Default Codename', 'last_center_name' => '0'])

<div class="border rounded-lg border-gray-500 m-4 p-4 bg-zinc-900 shadow-md w-full flex justify-between">
    <h1 class="text-zinc-50">{{ __($codename) }}</h1>
    <p class="">Last Center: {{ __($last_center_name) }}</p>
</div>