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

    /** Bind du datepicker TallStackUI (range) — tableau [start, end] */
    public array $dates = [];

    /** Liste des jours déjà réservés (Y-m-d) */
    public array $unavailableDates = [];

    public function mount(Property $property): void
    {
        $this->property = $property->loadMissing('bookings');

        $this->unavailableDates = $this->property->bookings
            ->flatMap(fn ($booking) =>
                collect(CarbonPeriod::create($booking->start_date, $booking->end_date))
                    ->map->format('Y-m-d')
            )
            ->unique()
            ->values()
            ->toArray();
    }

    protected function rules(): array
    {
        return [
            'dates'    => ['required', 'array', 'size:2'],
            'dates.0'  => ['required', 'date'],
            'dates.1'  => ['required', 'date', 'after:dates.0'],
        ];
    }

    public function reserve()
    {
        $this->validate();

        $start = $this->dates[0];
        $end   = $this->dates[1];

       

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
            $this->addError('dates', 'Ces dates sont déjà réservées.');
            return;
        }

        Booking::create([
            'property_id' => $this->property->id,
            'user_id'     => Auth::id(),
            'start_date'  => $start,
            'end_date'    => $end,
        ]);

       session()->flash('success', 'Réservation effectuée avec succès ✅');

return redirect()->route('user.bookings');
    }

    public function render()
    {
        return view('livewire.property-detail', [
            'unavailableDates' => $this->unavailableDates,
        ])->layout('layouts.app');
    }
}
