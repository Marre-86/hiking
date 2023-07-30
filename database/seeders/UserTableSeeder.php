<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        User::create([
            'name' => 'Robb Jones',
            'email' => 'a@a',
            'password' => Hash::make('aa'),
        ]);

        User::create([
            'name' => 'John Persimonn',
            'email' => 's@s',
            'password' => Hash::make('ss'),
        ]);

        User::create([
            'name' => 'Yulia Pesochkina',
            'email' => 'd@d',
            'password' => Hash::make('dd'),
        ]);
    }
}
