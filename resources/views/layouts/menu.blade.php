<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex space-4">
                    <a href="{{ route('apartments.index') }}"
                       class="@if(\Request::routeIs('apartments.*')) bg-gray-700 @endif text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                        Apartment List
                    </a>
                    <a href="{{ route('tasks.index') }}"
                       class="@if(\Request::routeIs('tasks.*')) bg-gray-700 @endif text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                        Task List
                    </a>
                    <a href="{{ route('tags.index') }}"
                       class="@if(\Request::routeIs('tags.*')) bg-gray-700 @endif text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                        Tags
                    </a>

                    @if (Auth::check())
                        <a href="#"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                            {{ Auth::user()->name }}
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf

                            <button class="text-white px-3 py-2 rounded-md text-sm font-medium" type="submit">
                                LOGOUT
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('google.redirect') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                            Login with Google
                        </a>
                        <a href="{{ route('register') }}"
                           class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                            Register
                        </a>
                    @endif

                    <a href="{{ route('lang', ['locale' => 'th']) }}"
                       class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">TH</a>

                    <a href="{{ route('lang', ['locale' => 'en']) }}"
                       class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">EN</a>

                </div>
            </div>
        </div>
    </div>
</nav>
