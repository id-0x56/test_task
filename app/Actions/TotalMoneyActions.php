<?php

namespace App\Actions;

use App\Models\TotalMoney;

class TotalMoneyActions
{
    private TotalMoney $totalMoney;

    public function __construct()
    {
        $this->totalMoney = TotalMoney::query()->first();
    }

    public function setValue(int $value = 0): void
    {
        $this->totalMoney->count = $value;
        $this->totalMoney->save();
    }

    public function getValue(): int
    {
        return $this->totalMoney->count;
    }
}
