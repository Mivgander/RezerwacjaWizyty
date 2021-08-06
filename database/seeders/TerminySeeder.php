<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerminySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++)
        {
            if(!in_array($i, [2, 6, 7]))
            {
                DB::table('terminy')->insert([
                    'data' => date('Y-m-d', mktime(0, 0, 0, 8, rand(8, 31), 2021)),
                    'godzina' => date('H:i', mktime(rand(8, 16), rand(0, 59))),
                    'status' => 'wolny',
                    'lekarze_id' => rand(1, 4)
                ]);
            }
            else
            {
                DB::table('terminy')->insert([
                    'data' => date('Y-m-d', mktime(0, 0, 0, 8, rand(8, 31), 2021)),
                    'godzina' => date('H:i', mktime(rand(8, 16), rand(0, 59))),
                    'status' => 'zarezerwowany',
                    'lekarze_id' => rand(1, 4)
                ]);
            }
        }
    }
}
