<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Tag;
use App\Models\Sport;
use App\Models\SportType;
use Illuminate\Support\Facades\DB;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::truncate();

        $activities = json_decode(file_get_contents(database_path('data/activities.json')), true);

        foreach ($activities as $activity) {
            $newActivityId = DB::table('activities')->insertGetId([
                'created_by_id' => $activity['created_by_id'],
                'sport_id' => Sport::where('name', $activity['sport_id'])->first()->id,
                'sport_type_id' => array_key_exists('sport_type_id', $activity) ? SportType::where('name', $activity['sport_type_id'])->first()->id : null,
                'name' => $activity['name'],
                'description' => $activity['description'],
                'distance' => $activity['distance'],
                'avgSpeed' => $activity['avgSpeed'],
                'avgPace' => $activity['avgPace'],
                'minAltitude' => $activity['minAltitude'],
                'maxAltitude' => $activity['maxAltitude'],
                'cumulativeElevationGain' => $activity['cumulativeElevationGain'],
                'cumulativeElevationLoss' => $activity['cumulativeElevationLoss'],
                'startedAt' => $activity['startedAt'],
                'duration' => $activity['duration'],
                'track_file' => $activity['track_file']
            ]);
            if (array_key_exists('tags', $activity)) {
                $newActivity = Activity::find($newActivityId);
                $newActivity->tags()->attach(Tag::whereIn('name', $activity['tags'])->pluck('id'));
                $newActivity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $activity['tags'])->pluck('id'));
            }
        }
    }
}
