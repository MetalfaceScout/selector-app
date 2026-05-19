<div>
    <div>
        <h3 class="dark:text-zinc-200">Lfstats Lookup</h3>
        <label for="center" class="block text-sm font-medium dark:text-zinc-200 text-zinc-700">Center</label>
        <select
            wire:change="updateCenter($event.target.value)"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
            @foreach($this->centers as $center)
                <option value="{{ $center->center_id }}" @selected(auth()->user()->center == $center->center_id)>
                    {{ $center->pretty_name }}
                </option>
            @endforeach
        </select>
        <x-text-input
            type="text"
            for="codename"
            wire:model.live.debounce.300ms="codename"
            >
        </x-text-input>
        <ul>
            @foreach($this->players as $player)
                <x-player-card-lfstats :player="collect($player)" />
            @endforeach
        </ul>
    </div>
</div>
