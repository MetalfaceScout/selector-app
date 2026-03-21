<div>
    <div class="mb-4">
        <label for="gametype" class="block text-sm font-medium dark:text-zinc-200 text-zinc-700">Game Type</label>
        <select id="gametype" wire:change="changeGametype($event.target.value)" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach(array_keys($teamConfigs) as $gametype)
                <option value="{{ $gametype }}">{{ $gametype }}</option>
            @endforeach
        </select>
    </div>
</div>
