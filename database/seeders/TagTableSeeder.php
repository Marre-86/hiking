<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();

        $tags = json_decode(file_get_contents(database_path('data/tags.json')), true);

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
