<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class PropertyDetail extends Component
{
    public Property $property;

    /** Champs finaux validés */
    public ?string $start_date = null;
    public ?string $end_date   = null;

    /** Bind interne du datepicker (range) — tableau [start, end] */
    public array $dates = [];

    /** Liste des jours déjà réservés (Y-m-d) */
    public array $unavailableDates = [];

    public function mount(Property $property): void
    {
        $this->property = $property->loadMissing('bookings');

        // Construit la liste des jours réservés
        $busy = [];
        foreach ($this->property->bookings as $booking) {
            foreach (CarbonPeriod::create($booking->start_date, $booking->end_date) as $day) {
                $busy[] = $day->format('Y-m-d');
            }
        }
        $this->unavailableDates = array_values(array_unique($busy));
    }

    /**
     * Synchronise le tableau du datepicker vers les deux strings
     */
    public function updatedDates($value): void
    {
        if (is_array($value) && count($value) === 2) {
            $this->start_date = $value[0] ?: null;
            $this->end_date   = $value[1] ?: null;
        } else {
            $this->start_date = null;
            $this->end_date   = null;
        }
    }

    protected function rules(): array
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date', 'after:start_date'],
        ];
    }

    public function reserve()
    {
        $this->validate();

        $start = $this->start_date;
        $end   = $this->end_date;

        // Vérifie s’il existe déjà une réservation qui chevauche la plage choisie
        $exists = Booking::where('property_id', $this->property->id)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($qq) use ($start, $end) {
                      $qq->where('start_date', '<=', $start)
                         ->where('end_date', '>=', $end);
                  });
            })
            ->exists();

        if ($exists) {
            $this->addError('start_date', 'Ces dates sont déjà réservées.');
            return;
        }

        // Création de la réservation
        Booking::create([
            'property_id' => $this->property->id,
            'user_id'     => Auth::id(),
            'start_date'  => $start,
            'end_date'    => $end,
        ]);

        session()->flash('success', 'Réservation effectuée avec succès ✅');

        return redirect()->route('properties.index');
    }

    public function render()
    {
        return view('livewire.property-detail', [
            'unavailableDates' => $this->unavailableDates,
        ])->layout('layouts.app');
    }
}
