<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sport;
use App\Models\SportType;

class SportTypeDropdown extends Component
{
    // Since sport is necessary, we have to assign default sport id right away
    public $sport = 1;

    public function render()
    {
        $sports = Sport::all();
        $sportTypes = $this->sport ? SportType::where('sport_id', $this->sport)->get() : [];

        return view('livewire.sport-type-dropdown', [
            'sports' => $sports,
            'sportTypes' => $sportTypes,
        ]);
    }
}
