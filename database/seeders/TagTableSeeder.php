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
            'alone',
            'group ride',
            'gnarly',
            'got injured',
            'with kiddo on the back',
            'best performance ever',
            'with company',
            'with a family',
            'cave',
            'in a wetsuit',
            'Issyk-Kul',
            'Kyrgyzstan',
            'Cholpon-Ata',
            'Park beach (Cholpon-Ata)',
            'Dog beach (Cholpon-Ata)',
            'Duck beach (Cholpon-Ata)',
            'Kapibara beach (Cholpon-Ata)',
            'Goluboy Issyk-Kul beach (Cholpon-Ata)',
            'Taiberik beach (Issyk-Kul)',
            'Kok-Moinok lake',
            'Bishkek'
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
