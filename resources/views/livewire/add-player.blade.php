<div>
    {{-- Stop trying to control. --}}
    <div>
        <h3 class="dark:text-zinc-200">Add a Player</h3>
        <form wire:submit.prevent="savePlayer" class="flex flex-wrap">
            <div>
                <x-input-label for="codename" :value="__('Player Name')" />
                <x-text-input id="codename" class="block mt-1 w-full" type="text" wire:model.defer="codename" placeholder="Enter player name" required />
                <x-input-error :messages="$errors->get('codename')" class="mt-2" />
            </div>
            <x-primary-button type="submit" class="ml-4 mt-2">Add Player</x-primary-button>
        </form> 
    </div>
</div>
