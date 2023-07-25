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

        $tags = [
            'family run',
            'Switzerland',
            'cold water',
            'poop break',
            'got drenched under the rain',
            'Kyrgyzstan',
            'alone',
            'group ride',
            'gnarly',
            'got injured',
            'with kiddo on the back',
            'best performance ever',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
