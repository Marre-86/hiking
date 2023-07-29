<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Tag;
use App\Models\Sport;
use App\Models\SportType;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::truncate();

        $sportRun = Sport::where('name', 'Running')->first();
        $sportSwim = Sport::where('name', 'Swimming')->first();
        $sportHike = Sport::where('name', 'Hiking')->first();

        $typeEasyRun = SportType::where('name', 'Easy run')->first();
        $typeLongRun = SportType::where('name', 'Long run')->first();
        $typeOutdoorSwim = SportType::where('name', 'Outdoor swimming')->first();

        Activity::create([
            'created_by_id' => 2,
            'sport_id' => $sportHike->id,
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
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeEasyRun->id,
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

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportHike->id,
            'name' => 'Hiking with a group (Kok-Moinok lake)',
            'description' => 'With an organized group.',
            'distance' => 24.21,
            'avgSpeed' => '2.6',
            'avgPace' => '22:47',
            'minAltitude' => 1624,
            'maxAltitude' => 2689,
            'cumulativeElevationGain' => 1883,
            'cumulativeElevationLoss' => 1875,
            'startedAt' => '2023-06-24 08:52:00',
            'duration' => '9:12:01',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-18.08.44.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Bishkek', 'with company', 'Kok-Moinok lake'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeEasyRun->id,
            'name' => 'Noon run in Bishkek on a scorching day',
            'description' => 'Very hot.',
            'distance' => 8.89,
            'avgSpeed' => '10',
            'avgPace' => '5:59',
            'minAltitude' => 771,
            'maxAltitude' => 834,
            'cumulativeElevationGain' => 152,
            'cumulativeElevationLoss' => 153,
            'startedAt' => '2023-06-28 11:12:00',
            'duration' => '0:53:13',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-18.01.00.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Bishkek'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'First swimming in Issyk-Kul',
            'description' => 'The water is pretty cool',
            'distance' => 0.69,
            'avgSpeed' => '1.4',
            'avgPace' => '42:07',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-01 14:37:00',
            'duration' => '0:29:11',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.38.46.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'Issyk-Kul', 'Kapibara beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportHike->id,
            'name' => 'Hiking with Alex and my family',
            'description' => 'Part of the way I carried Alisa on my shoulders.',
            'distance' => 9.27,
            'avgSpeed' => '2.5',
            'avgPace' => '24:13',
            'minAltitude' => 1962,
            'maxAltitude' => 2369,
            'cumulativeElevationGain' => 570,
            'cumulativeElevationLoss' => 579,
            'startedAt' => '2023-07-02 17:11:00',
            'duration' => '3:44:41',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.55.25.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'with a family', 'with company'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming in Issyk-Kul',
            'description' => '',
            'distance' => 0.63,
            'avgSpeed' => '1.5',
            'avgPace' => '40:44',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-03 19:03:00',
            'duration' => '0:25:29',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.27.21.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'Issyk-Kul', 'Goluboy Issyk-Kul beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming in Issyk-Kul (Taiberik)',
            'description' => '',
            'distance' => 0.53,
            'avgSpeed' => '1.7',
            'avgPace' => '35:36',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-04 17:31:00',
            'duration' => '0:18:57',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.23.11.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Issyk-Kul', 'Taiberik beach (Issyk-Kul)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeLongRun->id,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeLongRun->id,
            'name' => 'Long Run in Cholpon-Ata',
            'description' => '',
            'distance' => 14.25,
            'avgSpeed' => '9.4',
            'avgPace' => '6:21',
            'minAltitude' => 1616,
            'maxAltitude' => 1798,
            'cumulativeElevationGain' => 381,
            'cumulativeElevationLoss' => 444,
            'startedAt' => '2023-07-06 16:18:00',
            'duration' => '1:30:37',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.50.06.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming in Issyk-Kul',
            'description' => 'Elapsed time - 3 hours 14 minutes (took few long breaks)',
            'distance' => 0.76,
            'avgSpeed' => '1.4',
            'avgPace' => '44:11',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-11 12:20:00',
            'duration' => '0:33:36',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.17.53.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'Issyk-Kul', 'Goluboy Issyk-Kul beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeEasyRun->id,
            'name' => 'Easy run in Cholpon-Ata',
            'description' => 'Took couple stops to eat berries from the cherry tree',
            'distance' => 12.87,
            'avgSpeed' => '9.9',
            'avgPace' => '6:04',
            'minAltitude' => 1607,
            'maxAltitude' => 1787,
            'cumulativeElevationGain' => 232,
            'cumulativeElevationLoss' => 297,
            'startedAt' => '2023-07-12 17:06:00',
            'duration' => '1:18:06',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.12.18.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming in Issyk-Kul',
            'description' => '',
            'distance' => 0.92,
            'avgSpeed' => '1.4',
            'avgPace' => '43:05',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-14 15:23:00',
            'duration' => '0:39:44',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-17.06.51.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'Issyk-Kul', 'Park beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));
        
        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportHike->id,
            'name' => 'Hiking with my family and Kostya',
            'description' => 'The time is represented in the format "HH:mm:ss," where "HH" stands for the hours (two digits, ranging from 00 to 23), "mm" for the minutes (two digits, ranging from 00 to 59), and "ss" for the seconds (two digits, ranging from 00 to 59).',
            'distance' => 12.74,
            'avgSpeed' => '2.2',
            'avgPace' => '27:05',
            'minAltitude' => 1806,
            'maxAltitude' => 2202,
            'cumulativeElevationGain' => 839,
            'cumulativeElevationLoss' => 1046,
            'startedAt' => '2023-07-16 12:52:00',
            'duration' => '5:45:04',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-15.38.09.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'with a family', 'cave'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming at a Duck beach',
            'description' => 'Мне по душе строптивый норов<br>Артиста в силе: он отвык<br>От фраз, и прячется от взоров,<br>И собственных стыдится книг.',
            'distance' => 0.57,
            'avgSpeed' => '1.6',
            'avgPace' => '36:57',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-17 19:10:00',
            'duration' => '0:20:57',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-15.31.15.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon Ata', 'Issyk-Kul', 'Duck beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportSwim->id,
            'sport_type_id' => $typeOutdoorSwim->id,
            'name' => 'Swimming at a Dog beach',
            'description' => '',
            'distance' => 0.82,
            'avgSpeed' => '1.7',
            'avgPace' => '35:53',
            'minAltitude' => 0,
            'maxAltitude' => 0,
            'cumulativeElevationGain' => 0,
            'cumulativeElevationLoss' => 0,
            'startedAt' => '2023-07-18 17:32:00',
            'duration' => '0:29:36',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-12.58.34.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon Ata', 'Issyk-Kul', 'Dog beach (Cholpon-Ata)'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));


        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeLongRun->id,
            'name' => 'Забег в Чолпон-Ате под дождём',
            'description' => 'Выбрать несколько стихотворений из корпуса текстов поэта, много писавшего на протяжении пяти десятилетий, — задача трудная. Среди отобранного — стихи разных лет, представляющие и примеры сложного, образного, многозначного метафорического языка раннего Пастернака, и стихи пятидесятых годов, язык которых гораздо ровнее.',
            'distance' => 16.26,
            'avgSpeed' => '9.9',
            'avgPace' => '6:02',
            'minAltitude' => 1631,
            'maxAltitude' => 1806,
            'cumulativeElevationGain' => 407,
            'cumulativeElevationLoss' => 429,
            'startedAt' => '2023-07-19 18:54:00',
            'duration' => '1:38:19',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-12.26.31.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'got drenched under the rain', 'with company'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

        $activity = Activity::create([
            'created_by_id' => 3,
            'sport_id' => $sportRun->id,
            'sport_type_id' => $typeEasyRun->id,
            'name' => 'Забег в Чолпон-Ате (несвежий)',
            'description' => 'Пастернаку свойственна парадоксальность мировосприятия, любовь к каламбурам и философичность.',
            'distance' => 9.98,
            'avgSpeed' => '9.9',
            'avgPace' => '6:04',
            'minAltitude' => 1616,
            'maxAltitude' => 1793,
            'cumulativeElevationGain' => 238,
            'cumulativeElevationLoss' => 295,
            'startedAt' => '2023-07-24 16:23:00',
            'duration' => '1:00:34',
            'track_file' => '003-Yulia Pesochkina/2023.07.26-12.13.50.gpx'
        ]);
        $tags = ['Kyrgyzstan', 'Cholpon-Ata', 'gnarly'];
        $activity->tags()->attach(Tag::whereIn('name', $tags)->pluck('id'));
        $activity->created_by->tags()->syncWithoutDetaching(Tag::whereIn('name', $tags)->pluck('id'));

    }

    public function attachTags(): void
    {
        $activities = Activity::all();

        foreach ($activities as $activity) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->get();
            $activity->tags()->attach($tags);
            $activity->created_by->tags()->syncWithoutDetaching($tags);
        }
    }
}
