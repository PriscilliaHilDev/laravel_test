<nav class="w-full border-b border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-gray-900/80 backdrop-blur">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 h-16 flex items-center justify-between">
        {{-- Logo / Marque --}}
        <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Azuréa IMMO
        </a>

        {{-- Actions (droite) --}}
        <div class="flex items-center gap-3">
            @if (Route::has('login') && !request()->routeIs('login'))
                <a href="{{ route('login') }}"
                   class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium 
                          text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                    Se connecter
                </a>
            @endif

            @if (Route::has('register') && request()->routeIs('login'))
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium 
                          text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                    Créer un compte
                </a>
            @endif
        </div>
    </div>
</nav>
