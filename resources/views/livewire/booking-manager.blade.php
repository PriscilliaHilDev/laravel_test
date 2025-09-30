<div class="max-w-6xl mx-auto p-8">
    <h1 class="text-3xl font-extrabold mb-8 text-gray-900 dark:text-gray-100 tracking-tight">
        Mes réservations
    </h1>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-lg font-medium shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookings->isEmpty())
        <p class="text-lg text-gray-600 dark:text-gray-400">Vous n'avez pas encore de réservations.</p>
    @else
        <div class="space-y-6">
            @foreach ($bookings as $booking)
                <div class="p-6 border rounded-2xl shadow-lg bg-white dark:bg-gray-800 
                            flex items-center justify-between hover:shadow-xl transition">

                    {{-- Image + Infos --}}
                    <div class="flex items-center space-x-6">
                        {{-- Image cliquable vers le détail du bien --}}
                        <a href="{{ route('properties.show', $booking->property->id) }}">
                            <img src="{{ $booking->property->image_path 
                                        ? asset('storage/' . $booking->property->image_path) 
                                        : asset('images/properties/default.png') }}"
                                 class="w-28 h-28 object-cover rounded-2xl shadow-md hover:scale-105 hover:opacity-90 transition"
                                 alt="{{ $booking->property->name }}">
                        </a>

                        <div class="space-y-2">
                            <h2 class="text-xl font-bold text-blue-700 dark:text-blue-400">
                                <a href="{{ route('properties.show', $booking->property->id) }}" 
                                   class="hover:underline">
                                    {{ $booking->property->name }}
                                </a>
                            </h2>
                            <p class="text-base text-gray-700 dark:text-gray-300 leading-snug">
                                {{ \Illuminate\Support\Str::limit($booking->property->description, 90) }}
                            </p>
                            <p class="text-base text-gray-500 dark:text-gray-400">
                                <span class="font-medium">Du :</span> {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}
                                <span class="ml-3 font-medium">Au :</span> {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                                <span class="ml-3 text-sm">({{ $booking->nights }} nuits)</span>
                            </p>
                        </div>
                    </div>

                    {{-- Prix & Bouton --}}
                    <div class="text-right space-y-2">
                        <p class="text-lg font-semibold text-green-600 dark:text-green-400">
                            {{ number_format($booking->property->price_per_night, 2, ',', ' ') }} € / nuit
                        </p>
                        <p class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                            Total : {{ number_format($booking->total, 2, ',', ' ') }} €
                        </p>

                        <button wire:click="cancel({{ $booking->id }})"
                                class="mt-3 px-5 py-2.5 bg-red-600 text-white text-sm font-semibold rounded-xl shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition">
                            Annuler
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
