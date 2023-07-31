<?php

namespace Tests\Feature\Livewire;

use App\Models\Sport;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\SportTypeDropdown;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SportTypeDropdownTest extends TestCase
{
    use RefreshDatabase;

    public function testSportTypesDependOnSport(): void
    {
        $this->seed();

        $user = User::where('id', 3)->first();
        $this->actingAs($user);

        $sport = Sport::where('name', 'Running')->first();
        $sportTypesCount = $sport->sport_types->count();
        $randomSportType = $sport->sport_types->first();

        $component = Livewire::test(SportTypeDropdown::class)
            ->set('sport', $sport->id)
            ->assertSee($randomSportType->name);

        $activitiesInView = $component->viewData('sportTypes');
        $this->assertCount($sportTypesCount, $activitiesInView);
    }
}
