<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // ← Trait Livewire pour activer la pagination
use App\Models\Property;

class PropertyList extends Component
{
    use WithPagination;

    /**
     * Définit que la pagination utilise Tailwind (par défaut Livewire met Bootstrap).
     */
    protected string $paginationTheme = 'tailwind';

    /**
     * Rendu du composant Livewire.
     */
    public function render()
    {
        return view('livewire.property-list', [
            // On récupère les propriétés par date de création décroissante
            'properties' => Property::orderByDesc('created_at')
                ->paginate(9), // 9 cartes par page
        ])
        ->layout('layouts.app'); // Utilise le layout global pour user auth
    }
}
