<x-guest-layout>
    <div class="flex flex-col bg-gray-100">

        {{-- Top Navigation (Login / Register) --}}
        @if (Route::has('login'))
            <div class="w-full flex justify-center px-6 py-4 bg-gray-100 text-sm">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        {{-- Main Content --}}
        {{-- <div class="flex-grow flex items-center justify-center">
            <h1 class="text-4xl font-bold text-red-800">
                Welcome to PUP SCHEDEASE
            </h1>
        </div> --}}

        {{-- Footer --}}
        <footer class="bg-gray-200 py-6">
            <div class="max-w-2xl mx-auto text-center text-gray-700 text-sm">
                © {{ date('Y') }} PUP SCHEDEASE. All rights reserved.
            </div>
        </footer>

    </div>
</x-guest-layout>
