<div class="max-w-3xl mx-auto p-6">
    {{-- Message de succès --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Infos du bien --}}
    <h1 class="text-3xl font-bold mb-4">{{ $property->name }}</h1>

    {{-- Image principale --}}
    <div class="mb-6">
       <img src="{{ $property->image_path 
                ? asset('storage/' . $property->image_path) 
                : asset('images/properties/default.png') }}" 
     class="w-full h-full object-cover hover:scale-105 transition"
     alt="{{ $property->name }}">

    </div>

    <p class="mb-4">{{ $property->description }}</p>
    <p class="text-xl font-bold text-green-600 mb-6">
        {{ number_format($property->price_per_night, 2, ',', ' ') }} € / nuit
    </p>

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

            {{-- Erreurs personnalisées si besoin --}}
            @error('start_date')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
            @error('end_date')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <x-ts-button type="submit" class="w-full">
                Réserver ce bien
            </x-ts-button>
        </form>
    @else
        <p class="text-red-500 mt-4">Connectez-vous pour réserver ce bien.</p>
    @endauth
</div>
