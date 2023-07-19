<?php

namespace Tests\Feature\Activity;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testOwnActivitiesAreRenderedAndOthersAreNot(): void
    {
        $this->seed();

        $user = User::where('id', 2)->first();

        $activityOwn = Activity::where('created_by_id', 2)->firstOrFail();
        $activityOther = Activity::where('created_by_id', 1)->firstOrFail();

        $response = $this
            ->actingAs($user)
            ->get(route('activities.index'));

        $response->assertSee($activityOwn->name);
        $response->assertDontSee($activityOther->name);
    }

    public function testActivitiesAreNotRenderedForGuest(): void
    {
        $this->seed();

        $response = $this
            ->get(route('activities.index'));

        $response->assertStatus(403);
    }
}
