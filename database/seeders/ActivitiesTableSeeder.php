<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Tag;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::truncate();

        Activity::create([
            'created_by_id' => 2,
            'name' => 'Поход в высокие горы',
            'description' => 'The site of Toronto lay at the entrance to one of the oldest routes to the northwest, a route known and used by the Huron, Iroquois, and Ojibwe, and was of strategic importance from the beginning of Ontario\'s recorded history.',
            'distance' => 24.21,
            'avgSpeed' => '2.6',
            'avgPace' => '22:47',
            'minAltitude' => 1624,
            'maxAltitude' => 2689,
            'cumulativeElevationGain' => 1883,
            'cumulativeElevationLoss' => 1875,
            'startedAt' => '2023-06-24 08:52:00',
            'duration' => '9:12:01',
            'track_file' => '002-John Persimonn/2023.07.06-19.23.53.gpx'
        ]);

        Activity::create([
            'created_by_id' => 1,
            'name' => 'Забег в Чолпон-Ате',
            'description' => 'Над Белгородом и областью сработала система ПВО, которая сбила «несколько воздушных целей на подлете к городу». Об этом сообщил губернатор Белгородской области Вячеслав Гладков.',
            'distance' => 14.25,
            'avgSpeed' => '9.4',
            'avgPace' => '6:21',
            'minAltitude' => 1616,
            'maxAltitude' => 1798,
            'cumulativeElevationGain' => 381,
            'cumulativeElevationLoss' => 444,
            'startedAt' => '2023-07-06 10:18:00',
            'duration' => '1:30:37',
            'track_file' => '001-Robb Jones/2023.07.06-19.48.11.gpx'
        ]);

        $this->attachTags();
    }

    public function attachTags(): void
    {
        $activities = Activity::all();

        foreach ($activities as $activity) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->get();
            $activity->tags()->attach($tags);
            $activity->created_by->tags()->attach($tags);
        }
    }
}
