<x-app-layout>
    <div class="flex h-max w-auto justify-center">
        {{-- <div>
            <form method="POST" action="{{ url('api/teams')}}">
                <x-primary-button>
                    {{__('New Team')}}
                </x-primary-button>
            </form>
        </div> --}}
        <div>
            <div class="flex flex-wrap justify-center">
                @foreach (App\Models\Player::All() as $player)
                    <a class="dark:bg-zinc-700 dark:text-gray-300 p-4 rounded-md m-4" href="{{ route('players.edit', $player) }}">
                        {{ $player->codename }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>