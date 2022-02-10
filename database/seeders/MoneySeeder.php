<?php

namespace Database\Seeders;

use App\Models\Money;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {
            $user->moneys()->saveMany(Money::factory(1)->make([
                'user_id' => $user->id
            ]));
        });
    }
}
