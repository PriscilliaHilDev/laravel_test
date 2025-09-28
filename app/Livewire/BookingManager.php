<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $bookings;

    public function mount(): void
    {
        $this->loadBookings();
    }

    public function loadBookings(): void
    {
        $this->bookings = Booking::with('property')
            ->where('user_id', Auth::id())
            ->orderByDesc('start_date')
            ->get();
    }

    public function cancel($bookingId): void
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->delete();

        session()->flash('success', 'Votre réservation a été annulée avec succès ❌');

        $this->loadBookings();
    }

    public function render()
    {
        return view('livewire.booking-manager')
            ->layout('layouts.app');
    }
}
