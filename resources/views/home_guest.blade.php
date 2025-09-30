<x-guest-layout>
    <div class="bg-gray-200 dark:bg-gray-950 min-h-screen">
        <div class="dark:bg-gray-900">
<section id="default-carousel" class="relative w-full h-[400px] rounded-b-3xl " data-carousel="slide">
            <div class="relative h-[400px] overflow-hidden rounded-b-3xl">
                @for ($i = 1; $i <= 9; $i++)
                     <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/images/slide-' . $i . '.jpg') }}" 
                        class="absolute block w-full h-full object-cover object-center" 
                        alt="Slide {{ $i }}">
                    </div>
                @endfor

            </div>

            <!-- Indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                @for ($i = 0; $i < 9; $i++)
                    <button type="button" class="w-3 h-3 rounded-full bg-white/70 dark:bg-gray-600" 
                            aria-current="false" aria-label="Slide {{ $i+1 }}" 
                            data-carousel-slide-to="{{ $i }}"></button>
                @endfor
            </div>

            <!-- Controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/40 dark:bg-gray-800/40 group-hover:bg-white/60 dark:group-hover:bg-gray-700/70">
                    <svg class="w-4 h-4 text-white dark:text-gray-200 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/40 dark:bg-gray-800/40 group-hover:bg-white/60 dark:group-hover:bg-gray-700/70">
                    <svg class="w-4 h-4 text-white dark:text-gray-200 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </button>
        </section>
        </div>
        <!-- HERO avec carrousel Flowbite -->
        

        <!-- Texte accroche -->
        <section class="w-full bg-gray-100 dark:bg-gray-900 py-12 px-6 text-center shadow-sm">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    Trouvez votre maison de rêve avec 
                    <span class="text-blue-600 dark:text-blue-400">Azuréa IMMO</span>
                </h2>
                <p class="mt-4 text-lg text-gray-700 dark:text-gray-300">
                    Découvrez une sélection unique de biens immobiliers soigneusement choisis pour vous.  
                    Réservez dès maintenant et vivez une expérience en toute sérénité.
                </p>
                <div class="mt-6">
                    <a href="{{ route('properties.index') }}"
                       class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 text-lg font-medium text-white 
                              hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                        Explorer nos biens
                    </a>
                </div>
            </div>
        </section>

        <!-- 3 avantages -->
        <section class="max-w-7xl mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center text-center bg-gray-100 dark:bg-gray-900 rounded-2xl shadow 
                        hover:shadow-lg p-8 transition ring-1 ring-gray-200 dark:ring-gray-700">
                <img src="/icons/easy.svg" class="w-12 h-12 mb-4" alt="Simplicité">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Réservation simplifiée</h3>
                <p class="mt-2 text-gray-700 dark:text-gray-500">
                    Trouvez et réservez en quelques clics, grâce à une interface claire et intuitive.
                </p>
            </div>

            <div class="flex flex-col items-center text-center bg-gray-100 dark:bg-gray-900 rounded-2xl shadow 
                        hover:shadow-lg p-8 transition ring-1 ring-gray-200 dark:ring-gray-700">
                <img src="/icons/secure.svg" class="w-12 h-12 mb-4" alt="Sécurité">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Paiement sécurisé</h3>
                <p class="mt-2 text-gray-700 dark:text-gray-300">
                    Toutes vos transactions sont protégées, pour réserver en toute confiance.
                </p>
            </div>

            <div class="flex flex-col items-center text-center bg-gray-100 dark:bg-gray-900 rounded-2xl shadow 
                        hover:shadow-lg p-8 transition ring-1 ring-gray-200 dark:ring-gray-700">
                <img src="/icons/support.svg" class="w-12 h-12 mb-4" alt="Support">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Assistance rapide</h3>
                <p class="mt-2 text-gray-700 dark:text-gray-300">
                    Une équipe disponible pour répondre à vos questions et vous accompagner.
                </p>
            </div>
        </section>

        <!-- Dernières propriétés -->
        <section class="w-full max-w-7xl mx-auto py-12 px-6 bg-gray-200 dark:bg-gray-800 rounded-2xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dernières propriétés</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($latest as $property)
                    <article class="rounded-2xl bg-gray-100 dark:bg-gray-900 p-5 shadow-sm 
                                    ring-1 ring-gray-200 dark:ring-gray-700 hover:shadow-lg transition">
                        <div class="aspect-video w-full rounded-xl bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            <img src="/images/property-placeholder.jpg" 
                                 class="w-full h-full object-cover" 
                                 alt="{{ $property->name }}">
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('properties.show', $property->id) }}" class="hover:underline">
                                {{ $property->name }}
                            </a>
                        </h3>

                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                            {{ \Illuminate\Support\Str::limit($property->description, 120) }}
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-base font-bold text-green-600 dark:text-green-400">
                                {{ number_format($property->price_per_night, 2, ',', ' ') }} € / nuit
                            </span>
                            <a href="{{ route('properties.show', $property->id) }}"
                               class="rounded-lg bg-blue-600 dark:bg-blue-500 px-3 py-2 text-sm font-medium text-white 
                                      hover:bg-blue-700 dark:hover:bg-blue-600 transition">
                                Détails
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-gray-600 dark:text-gray-400">Aucune propriété pour le moment.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-guest-layout>
