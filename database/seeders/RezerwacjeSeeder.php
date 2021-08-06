<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RezerwacjeSeeder extends Seeder
{
    public function powod()
    {
        return Collection::make([
            'kaszel, katar i gorączka',
            'ogólne osłabienie',
            'wizyta kontrolna',
            'zakładanie gipsu',
            'biegunka',
            'szczepienie',
            'badanie krwi',
            'badanie wzroku',
            'badanie słuchu'
        ])->random();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rezerwacje')->insert([
            'email' => Str::random(8).'@gmail.com',
            'powod_rezerwacji' => $this->powod(),
            'terminy_id' => 2
        ]);

        DB::table('rezerwacje')->insert([
            'email' => Str::random(8).'@gmail.com',
            'powod_rezerwacji' => $this->powod(),
            'terminy_id' => 6
        ]);

        DB::table('rezerwacje')->insert([
            'email' => Str::random(8).'@gmail.com',
            'powod_rezerwacji' => $this->powod(),
            'terminy_id' => 7
        ]);
    }
}
