<x-app-layout>
    <main class="flex-1 w-full max-w-7xl mx-auto px-6 lg:px-8 py-12 space-y-20 text-center flex flex-col items-center">

        <!-- Section Hero avec carousel -->
        <section class="flex flex-col lg:flex-row items-center justify-center gap-12">
            <div class="flex-1">
                <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl text-gray-900 dark:text-gray-100">
                    Bienvenue 👋
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Retrouvez facilement votre prochain logement de vacances ou de travail.  
                    Gérez vos réservations en toute simplicité et profitez d'une expérience fluide et sécurisée.  
                </p>
                  <a href="{{ route('properties.index') }}"
                    class="mt-6 inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 text-lg font-medium text-white 
                      hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                    Voir les biens disponibles
                </a>
            </div>
            <!-- Carousel -->
            <aside class="flex-1 w-full lg:block">
                <section id="user-carousel" class="relative h-[300px] rounded-2xl overflow-hidden" data-carousel="slide">
                    <div class="relative h-full w-full overflow-hidden rounded-2xl">
                        @for ($i = 1; $i <= 5; $i++)
                               <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ asset('images/slides/slide-' . $i . '.jpg') }}" 
                                        class="absolute block w-full h-full object-cover object-center" 
                                        alt="Slide {{ $i }}">
                                </div>
                        @endfor
                    </div>
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-3 left-1/2">
                        @for ($i = 0; $i < 5; $i++)
                            <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/60 dark:bg-gray-700" 
                                    aria-current="false" aria-label="Slide {{ $i+1 }}" 
                                    data-carousel-slide-to="{{ $i }}"></button>
                        @endfor
                    </div>
                </section>
            </aside>
        </section>


        <!-- Comment ça marche -->
        <section class="max-w-4xl">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-8">Comment ça marche ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow ring-1 ring-gray-100 dark:ring-gray-700">
                    <span class="text-3xl font-extrabold text-blue-600">1</span>
                    <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">Parcourez</h3>
                    <p class="text-gray-600 dark:text-gray-300">Explorez nos biens disponibles selon vos critères.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow ring-1 ring-gray-100 dark:ring-gray-700">
                    <span class="text-3xl font-extrabold text-blue-600">2</span>
                    <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">Réservez</h3>
                    <p class="text-gray-600 dark:text-gray-300">Réservez instantanément en ligne et recevez une confirmation.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow ring-1 ring-gray-100 dark:ring-gray-700">
                    <span class="text-3xl font-extrabold text-blue-600">3</span>
                    <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">Profitez</h3>
                    <p class="text-gray-600 dark:text-gray-300">Installez-vous et profitez de votre séjour en toute tranquillité.</p>
                </div>
            </div>
        </section>

        <!-- CTA final -->
        <section class="text-center py-4">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Prêt à réserver votre prochain séjour ?</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Découvrez nos propriétés et vivez une expérience simple et agréable.
            </p>
          
        </section>
    </main>
</x-app-layout>
