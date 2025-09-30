<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class PropertyDetail extends Component
{
    /** Le bien en cours d'affichage */
    public Property $property;

    /** 
     * Bind du datepicker TallStackUI (mode range).
     * Exemple : ["2025-10-01", "2025-10-05"]
     */
    public array $dates = [];

    /** Liste des jours déjà réservés (format Y-m-d) pour désactiver dans le calendrier */
    public array $unavailableDates = [];

    /**
     * Monte le composant avec la propriété chargée.
     * On pré-remplit les dates indisponibles en fonction des réservations existantes.
     */
    public function mount(Property $property): void
    {
        // Charge la propriété et sa relation bookings
        $this->property = $property->loadMissing('bookings');

        // Parcours toutes les réservations pour récupérer chaque jour réservé
        $this->unavailableDates = $this->property->bookings
            ->flatMap(fn ($booking) =>
                collect(CarbonPeriod::create($booking->start_date, $booking->end_date))
                    ->map->format('Y-m-d') // formate chaque jour en "2025-10-01"
            )
            ->unique() // supprime les doublons
            ->values()
            ->toArray();
    }

    /**
     * Règles de validation pour la réservation.
     * - On attend un tableau de 2 dates (début et fin).
     * - La 2e doit être postérieure à la 1ère.
     */
    protected function rules(): array
    {
        return [
            'dates'    => ['required', 'array', 'size:2'],
            'dates.0'  => ['required', 'date'],
            'dates.1'  => ['required', 'date', 'after:dates.0'],
        ];
    }

    /**
     * Tente de réserver le bien sur les dates sélectionnées.
     * - Valide l'entrée utilisateur.
     * - Vérifie si les dates se chevauchent avec une réservation existante.
     * - Crée la réservation si libre.
     */
    public function reserve()
    {
        $this->validate();

        $start = $this->dates[0];
        $end   = $this->dates[1];

        // Vérifie s'il existe déjà une réservation sur l'intervalle
        $exists = Booking::where('property_id', $this->property->id)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])   // début dans la période
                  ->orWhereBetween('end_date', [$start, $end])   // fin dans la période
                  ->orWhere(function ($qq) use ($start, $end) {  // réservation englobante
                      $qq->where('start_date', '<=', $start)
                         ->where('end_date', '>=', $end);
                  });
            })
            ->exists();

        if ($exists) {
            // Ajoute une erreur personnalisée affichée dans la vue
            $this->addError('dates', 'Ces dates sont déjà réservées.');
            return;
        }

        // Création de la réservation
        Booking::create([
            'property_id' => $this->property->id,
            'user_id'     => Auth::id(),
            'start_date'  => $start,
            'end_date'    => $end,
        ]);

        // Message flash de confirmation
        session()->flash('success', 'Réservation effectuée avec succès ✅');

        // Redirection vers la page des réservations
        return redirect()->route('user.bookings');
    }

    /**
     * Rend la vue associée au composant.
     * On passe les dates indisponibles pour désactiver les jours dans le datepicker.
     */
    public function render()
    {
        return view('livewire.property-detail', [
            'unavailableDates' => $this->unavailableDates,
        ])->layout('layouts.app');
    }
}
