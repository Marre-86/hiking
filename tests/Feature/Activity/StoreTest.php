<?php

namespace Tests\Feature\Activity;

use App\Models\Activity;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testActivityIsStoredIntoDatabaseAndTrackFileIsStoredInStorage(): void
    {
        $this->seed();

        Storage::fake('public');
        $sizeInKilobytes = 500;
        $file = UploadedFile::fake()->create(
            'my_track_file.gpx',
            $sizeInKilobytes,
            'application/gpx+xml'
        );

        $tags = ['one', 'seven'];

        $newActivity = ([
            'name' => 'Тестовый кросс-поход',
            'description' => 'To call Bowie a transitional figure in rock history is less a judgment than a job descr.',
            'track_file' => $file,
        ]);

        $user = User::where('id', 2)->first();
        $response = $this
            ->actingAs($user)
            ->post(route('activities.store'), [...$newActivity, 'tags' => $tags, 'sport' => 4]);

        $activity = Activity::where('name', 'Тестовый кросс-поход')->firstOrFail();

        $fileName =  '002-John Persimonn/' . now()->format('Y.m.d-H.i.s') . '.gpx';
        $newActivityInDB = array_merge($newActivity, ['track_file' => $fileName]);

        $response->assertRedirectToRoute('activities.show', ['activity' => $activity]);
        $this->assertDatabaseHas('activities', $newActivityInDB);

        foreach ($tags as $tag) {
            $tagId = Tag::where('name', $tag)->first()->id;
            $this->assertDatabaseHas('activity_tag', [
                'activity_id' => $activity->id,
                'tag_id' => $tagId,
            ]);
            $this->assertDatabaseHas('tag_user', [
                'user_id' => Auth::user()->id,
                'tag_id' => $tagId,
            ]);
        }

        Storage::disk('public')->assertExists('track_files/' . $fileName);
    }

    public function testNotGPXTrackFileExtensionIsNotAccepted(): void
    {
        $this->seed();

        Storage::fake('public');
        $sizeInKilobytes = 500;
        $file = UploadedFile::fake()->create(
            'my_track_file.mp3',
            $sizeInKilobytes,
            'application/gpx+xml'
        );

        $newActivity = ([
            'name' => 'Тестовый кросс-поход',
            'description' => 'To call Bowie a transitional figure in rock history is less a judgment than a job descr.',
            'track_file' => $file
        ]);

        $user = User::where('id', 2)->first();
        $response = $this
            ->actingAs($user)
            ->post(route('activities.store'), $newActivity);

        $response->assertInvalid(['filename']);

        $fileName =  '002-John Persimonn/' . now()->format('Y.m.d-H.i.s') . '.gpx';
        Storage::disk('public')->assertMissing('track_files/' . $fileName);
    }

    public function testNotGPXTrackFileIsNotAccepted(): void
    {
        $this->seed();

        Storage::fake('public');
        $sizeInKilobytes = 500;
        $file = UploadedFile::fake()->create(
            'my_track_file.gpx',
            $sizeInKilobytes,
            'audio/mpeg'
        );

        $newActivity = ([
            'name' => 'Тестовый кросс-поход',
            'description' => 'To call Bowie a transitional figure in rock history is less a judgment than a job descr.',
            'track_file' => $file
        ]);

        $user = User::where('id', 2)->first();
        $response = $this
            ->actingAs($user)
            ->post(route('activities.store'), $newActivity);

        $response->assertInvalid(['track_file']);

        $fileName =  '002-John Persimonn/' . now()->format('Y.m.d-H.i.s') . '.gpx';
        Storage::disk('public')->assertMissing('track_files/' . $fileName);
    }

    public function testExtractsRightDataFromGPXTrackFile(): void
    {
        $this->seed();

        Storage::fake('test_disk');

        $newActivity = ([
            'name' => 'Забег в Бишкеке',
            'track_file' => new \Illuminate\Http\UploadedFile(resource_path('testing/test_zabeg.gpx'), 'test_zabeg.gpx', null, null, true)   // phpcs:ignore
        ]);

        $user = User::where('id', 2)->first();
        $response = $this
            ->actingAs($user)
            ->post(route('activities.store'), [...$newActivity, 'sport' => 1]);


        $activity = Activity::where('name', 'Забег в Бишкеке')->firstOrFail();

        $expectedData = [
            'distance' => 7.95,
            'duration' => '0:49:38',
        ];

        $this->assertEquals($expectedData['distance'], $activity->distance);
        $this->assertEquals($expectedData['duration'], $activity->duration);
    }
}
