<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'min_point' => 10,
                'max_point' => 100,

                'min_money' => 1,
                'max_money' => 5,

                'conversion_rate' => 10,
            ],
        ];
        DB::table('settings')->insert($settings);
    }
}
