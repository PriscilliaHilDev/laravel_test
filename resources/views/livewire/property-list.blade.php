
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-12">
        @if (session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
        {{ session('success') }}
    </div>
@endif
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Titre -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                    Nos propriétés disponibles
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Parcourez notre sélection et trouvez le logement idéal.
                </p>
            </div>

            <!-- Grille de cartes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($properties as $property)
                    <article class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-lg transition ring-1 ring-gray-100 dark:ring-gray-700 p-5">
                        
                        <!-- Image -->
                        <div class="aspect-video rounded-xl bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            <img src="{{ $property->image_url ?? '/images/property-placeholder.jpg' }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition"
                                 alt="{{ $property->name }}">
                        </div>

                        <!-- Contenu -->
                        <div class="mt-4">
                           <!-- Titre de la carte -->
<h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
    <a href="{{ route('properties.show', $property) }}" class="hover:underline">
        {{ $property->name }}
    </a>
</h2>

                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ \Illuminate\Support\Str::limit($property->description, 100) }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-base font-bold text-green-600 dark:text-green-400">
                                    {{ number_format($property->price_per_night, 2, ',', ' ') }} € / nuit
                                </span>
                               <!-- Bouton Voir plus -->
<a href="{{ route('properties.show', $property) }}"
   class="rounded-lg bg-blue-600 dark:bg-blue-500 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 dark:hover:bg-blue-600 transition">
    Voir plus
</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-gray-500 dark:text-gray-400 text-center">
                        Aucune propriété disponible pour le moment.
                    </p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
{{ $properties->links('vendor.pagination.tailwind') }}
            </div>

        </div>
    </div>
