<div class="p-2">
    <!-- He who is contented is rich. - Laozi -->
     <form method="GET" action="{{ route('search_player') }}">
        <x-input-label for="codename" :value="__('Search Codename:')" />
        <x-text-input id="codename" class="block mt-1 w-full"
            type="text"
            name="codename"
            required />
        
        <x-primary-button type="submit">Search</x-primary-button>
     </form>
</div>