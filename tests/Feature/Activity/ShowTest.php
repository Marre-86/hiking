<?php

namespace Tests\Feature\Activity;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testActivityIsRendered(): void
    {
        $this->seed();

        $user = User::where('id', 2)->first();

        $activity = Activity::where('created_by_id', 2)->firstOrFail();

        $response = $this
            ->actingAs($user)
            ->get(route('activities.show', $activity));

        $response->assertOk();
        $response->assertSee($activity->name);
    }
}
