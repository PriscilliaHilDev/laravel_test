<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Mes réservations</h1>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookings->isEmpty())
        <p class="text-gray-600">Vous n'avez pas encore de réservations.</p>
    @else
        <div class="space-y-4">
            @foreach ($bookings as $booking)
                <div class="p-4 border rounded-lg shadow-sm bg-white flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-blue-700">
                            {{ $booking->property->name }}
                        </h2>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $booking->property->description }}
                        </p>
                        <p>
                            <span class="font-medium">Du :</span>
                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}
                            <span class="ml-2 font-medium">Au :</span>
                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                        </p>
                        <p class="text-green-600 font-bold mt-2">
                            {{ number_format($booking->property->price_per_night, 2, ',', ' ') }} € / nuit
                        </p>
                    </div>
                    <div>
                        <button wire:click="cancel({{ $booking->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Annuler
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
