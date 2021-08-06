<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LekarzeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lekarze')->insert([
            'imie' => 'Adam',
            'nazwisko' => 'Kowalski'
        ]);

        DB::table('lekarze')->insert([
            'imie' => 'Joanna',
            'nazwisko' => 'Zaręba'
        ]);

        DB::table('lekarze')->insert([
            'imie' => 'Piotr',
            'nazwisko' => 'Nowak'
        ]);

        DB::table('lekarze')->insert([
            'imie' => 'Monika',
            'nazwisko' => 'Mazur'
        ]);
    }
}
