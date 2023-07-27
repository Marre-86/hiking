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

        $sports = [
            'Running',
            'Swimming',
            'Cycling',
            'Hiking',
        ];

        foreach ($sports as $sport) {
            Sport::create(['name' => $sport]);
        }
    }
}
