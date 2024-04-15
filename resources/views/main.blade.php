<x-guest-layout>
    <div>
        <h3 class="text-center dark:text-gray-300 text-5xl">Team Selector</h3>
        {{-- @if (Route::has('login'))
            <div class="p-4 m-4">
                @auth
                    <div class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </div> 
                    @else
                    <a href=" {{ url('/login')}}" class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">Login</a>
                        @if (Route::has('register'))
                        <a href=" {{ url('/register')}}" class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">Register</a>
                        @endif
                @endauth
            </div>
        @endif --}}
    </div>
    <div class="">
        @if (Route::has('login'))
            @auth
                <form method="GET" action="{{ url('/editor')}}" class="flex justify-center m-8">
                    <x-primary-button class="text-4xl">
                        Enter Editor
                    </x-primary-button>
                </form>
            @else
                <form method="GET" action="{{ url('login') }}" class="flex justify-center m-8">
                    <x-primary-button class="text-4xl">
                        Login
                    </x-primary-button>
                </form>
            @endauth
        @endif
    </div>
</x-guest-layout>