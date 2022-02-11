<?php

namespace Database\Seeders;

use App\Models\TotalItem;
use App\Models\TotalMoney;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class TotalItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TotalItem::factory(5)->create();
    }
}
