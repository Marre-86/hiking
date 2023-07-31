<?php

namespace Tests\Feature\Livewire;

use App\Models\Activity;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\SearchActivities;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchActivitiesTest extends TestCase
{
    use RefreshDatabase;

    public function testFilteringWorksAsExpected(): void
    {
        $this->seed();

        $user = User::where('id', 3)->first();
        $this->actingAs($user);

        $component = Livewire::test(SearchActivities::class)
            ->set('searchTag1', 'cave')
            ->assertSee('Hiking with my family and Kostya');

        $activitiesInView = $component->viewData('activities');
        $this->assertCount(1, $activitiesInView);

        $component = Livewire::test(SearchActivities::class)
            ->set('searchSport', 1)
            ->set('searchSportType', 1)
            ->set('searchTag2', 'Cholpon-Ata')
            ->assertSee('Забег в Чолпон-Ате (несвежий)');

        $activitiesInView = $component->viewData('activities');
        $this->assertCount(2, $activitiesInView);

        $component = Livewire::test(SearchActivities::class)
            ->set('searchActivityName', 'at');

        $activitiesInView = $component->viewData('activities');
        $this->assertCount(4, $activitiesInView);
    }

    public function testSportTypeNullifiesAfterRepeatedSportSelection(): void
    {
        $this->seed();

        $user = User::where('id', 3)->first();
        $this->actingAs($user);

        $component = Livewire::test(SearchActivities::class)
            ->set('searchSport', 1)
            ->set('searchSportType', 1)
            ->set('searchSport', 2)
            ->assertSet('searchSportType', '');
    }
}
