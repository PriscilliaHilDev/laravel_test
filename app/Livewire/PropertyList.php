<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;   // ← Ajoute ce trait
use App\Models\Property;

class PropertyList extends Component
{
    use WithPagination;  // ← Active la pagination Livewire

    public function render()
    {
        return view('livewire.property-list', [
            'properties' => Property::paginate(9), 
        ])->layout('layouts.app'); 
    }
}
