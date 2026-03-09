@props(['player']) 

<div 
    draggable="true"
    ondragstart="event.dataTransfer.setData('text/plain', '{{ $player->id }}')"
    class="p-4 relative border rounded shadow cursor-grab active:cursor-grabbing w-fit bg-white dark:bg-zinc-800 border-gray-200 dark:border-zinc-700"
>
    <div class="flex justify-between items-start">
        <div class="px-2">
            <p class="font-medium text-gray-800 dark:text-zinc-200">{{ $player->codename }}</p>
        </div>

        <div x-data="{ 
            open: false, 
            commander_mvp: {{ $player->commander_mvp }}, 
            heavy_mvp: {{ $player->heavy_mvp }},
            scout_mvp: {{ $player->scout_mvp }},
            ammo_mvp: {{ $player->ammo_mvp }},
            medic_mvp: {{ $player->medic_mvp }},
            lfstats_id: {{ $player->lfstats_id }},
            }"
            class="relative"
            >
            <button @click="open = !open" type="button" class="p-1 text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-zinc-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false" style="display: none;" class="absolute right-0 z-10 w-48 mt-1 bg-white dark:bg-zinc-700 border border-gray-200 dark:border-zinc-600 rounded-md shadow-lg overflow-hidden">
                <div class="p-3">
                    <label class="block text-xs text-gray-500 dark:text-gray-300 uppercase mb-2">Set MVP Score</label>
                    
                    <div class="flex flex-col items-center">
                        <div class="flex items-center space-x-1">
                            <img class="w-6" src="icons/commander.svg">
                            <input 
                                type="number" 
                                x-model="commander_mvp"
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>
                        

                        <div class="flex items-center space-x-1">
                            <img class="w-6" src="icons/heavy.svg">
                            <input 
                                type="number" 
                                x-model=heavy_mvp
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-center space-x-1">
                            <img class="w-6" src="icons/scout.svg">
                            <input 
                                type="number" 
                                x-model=scout_mvp
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-center space-x-1">
                            <img class="w-6" src="icons/ammo.svg">
                            <input 
                                type="number" 
                                x-model=ammo_mvp
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-center space-x-1">
                            <img class="w-6" src="icons/medic.svg">
                            <input 
                                type="number" 
                                x-model=medic_mvp
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <x-secondary-button 
                            @click.="$wire.updateMvp({{ $player->id }}, commander_mvp, heavy_mvp, scout_mvp, ammo_mvp, medic_mvp); open = false"
                            class="my-2 px-3 py-1 text-xs font-semibold"
                        >
                            Save
                        </x-secondary-button>

                        <div class="flex items-center space-x-1">
                            <h1 class="dark:text-zinc-400">ID</h1>
                            <input 
                                type="number" 
                                x-model=lfstats_id
                                class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-zinc-500 rounded bg-white dark:bg-zinc-800 text-gray-800 dark:text-zinc-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                        </div>

                        <x-secondary-button 
                            @click.="$wire.updateFromLfstats({{ $player->id }}, lfstats_id); open = false"
                            class="my-2 px-3 py-1 text-xs font-semibold"
                        >
                            Lfstats Update
                        </x-secondary-button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>