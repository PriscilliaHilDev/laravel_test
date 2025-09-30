<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingManager extends Component
{
    public $bookings;

    /**
     * Méthode exécutée automatiquement au montage du composant
     * → On charge les réservations de l'utilisateur connecté.
     */
    public function mount(): void
    {
        $this->loadBookings();
    }

    /**
     * Charge les réservations de l'utilisateur connecté avec la relation property.
     * On calcule aussi le nombre de nuits et le prix total pour chaque réservation.
     */
    private function loadBookings(): void
    {
        $this->bookings = Booking::with('property')
            ->where('user_id', Auth::id()) // uniquement les réservations du user connecté
            ->orderByDesc('start_date')    // les plus récentes en premier
            ->get()
            ->map(function ($booking) {
                // Conversion des dates en objets Carbon
                $start  = Carbon::parse($booking->start_date);
                $end    = Carbon::parse($booking->end_date);

                // Nombre de nuits réservées
                $nights = $start->diffInDays($end);

                // Ajout d'attributs calculés au modèle Booking
                $booking->nights = $nights;
                $booking->total  = $nights * $booking->property->price_per_night;

                return $booking;
            });
    }

    /**
     * Annule une réservation donnée par son ID
     * → Vérifie que la réservation appartient bien à l'utilisateur.
     */
    public function cancel(int $bookingId): void
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // lève une erreur si non trouvé

        // Suppression de la réservation
        $booking->delete();

        // Message flash pour notifier l'utilisateur
        session()->flash('success', 'Votre réservation a été annulée avec succès ❌');

        // Recharge la liste après suppression
        $this->loadBookings();
    }

    /**
     * Rend la vue Blade associée au composant Livewire
     */
    public function render()
    {
        return view('livewire.booking-manager')
            ->layout('layouts.app');
    }
}
