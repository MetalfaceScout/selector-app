@props(['player']) <div 
    draggable="true"
    ondragstart="event.dataTransfer.setData('text/plain', '{{ $player->id }}')"
    class="p-4 relative border rounded shadow cursor-grab active:cursor-grabbing w-fit"
>
    <div class="flex justify-between">
        <div class="px-2">
            <p class="font-medium text-gray-800 dark:text-zinc-200">{{ $player->codename }}</p>
        </div>

        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" type="button" class="p-1 text-gray-400 rounded hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false" style="display: none;" class="absolute right-0 z-10 w-40 mt-1 bg-white border border-gray-200 rounded-md shadow-lg">
                <div class="py-1">
                    <p class="px-4 py-2 text-xs text-gray-400 uppercase">Set MVP</p>
                    <button wire:click="updateMvp({{ $player->id }}, 1)" @click="open = false" class="block w-full px-4 py-2 text-sm text-left hover:bg-blue-50">Level 1</button>
                    <button wire:click="updateMvp({{ $player->id }}, 2)" @click="open = false" class="block w-full px-4 py-2 text-sm text-left hover:bg-blue-50">Level 2</button>
                    <button wire:click="updateMvp({{ $player->id }}, 0)" @click="open = false" class="block w-full px-4 py-2 text-sm text-left text-red-600 border-t border-gray-100 hover:bg-red-50">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>