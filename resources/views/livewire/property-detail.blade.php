<div class="max-w-4xl mx-auto p-6">
    {{-- Message de succès --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Infos du bien --}}
    <h1 class="text-3xl font-extrabold mb-4 text-gray-900 dark:text-gray-100">
        {{ $property->name }}
    </h1>

    {{-- Image principale --}}
    <div class="mb-6">
        <img src="{{ $property->image_path 
                ? asset('storage/' . $property->image_path) 
                : asset('images/properties/default.png') }}" 
             class="w-full max-h-[400px] rounded-2xl object-cover shadow-lg hover:scale-105 transition"
             alt="{{ $property->name }}">
    </div>

    {{-- Description --}}
    <p class="mb-4 text-gray-700 dark:text-gray-300 leading-relaxed">
        {{ $property->description }}
    </p>

    {{-- Prix --}}
    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mb-6">
        {{ number_format($property->price_per_night, 2, ',', ' ') }} € / nuit
    </p>

    {{-- Réservation ou message --}}
    @auth
        <form wire:submit.prevent="reserve" class="space-y-6">
            {{-- Datepicker TallStackUI (mode range) --}}
            <x-ts-date
                label="Période de séjour"
                name="dates"
                placeholder="Choisissez vos dates"
                hint="Sélectionnez une période"
                range
                parse-format="Y-m-d"
                display-format="d/m/Y"
                wire:model="dates"
                :disable="$unavailableDates"
            />

            {{-- Erreurs --}}
            @error('start_date')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            @error('end_date')
                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            <x-ts-button 
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white
                    dark:bg-blue-500 dark:hover:bg-blue-600
                    focus:outline-none focus:ring-2 focus:ring-offset-2 
                    focus:ring-blue-500 dark:focus:ring-blue-400"
            >
                Réserver ce bien
            </x-ts-button>
        </form>
    @else
        <p class="text-red-600 dark:text-red-400 mt-4 text-center font-medium">
            Connectez-vous pour réserver ce bien.
        </p>
    @endauth
</div>
