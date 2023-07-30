<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sport;

class SportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sport::truncate();

        $sports = json_decode(file_get_contents(database_path('data/sports.json')), true);

        foreach ($sports as $sport) {
            Sport::create(['name' => $sport]);
        }
    }
}
