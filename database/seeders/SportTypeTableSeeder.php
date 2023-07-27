<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sport;
use App\Models\SportType;

class SportTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportType::truncate();

        $runningTypes = [
            'Easy run',
            'Fartlek',
            'Interval training',
            'Tempo run',
            'Race',
            'Regeneration run',
            'Long run',
            'Mountain run',
            'Stair run',
            'Treadmill',
        ];

        $runningSport = Sport::where('name', 'Running')->first();

        foreach ($runningTypes as $typeName) {
            $sportType = new SportType(['name' => $typeName]);
            $runningSport->sport_types()->save($sportType);
        }

        $swimmingTypes = [
            'Indoor swimming',
            'Outdoor swimming',
        ];

        $swimmingSport = Sport::where('name', 'Swimming')->first();

        foreach ($swimmingTypes as $typeName) {
            $sportType = new SportType(['name' => $typeName]);
            $swimmingSport->sport_types()->save($sportType);
        }

    }
}
