<?php

namespace App\Actions;

use App\Models\Money;

class MoneyActions
{
    /**
     * @var Money
     */
    private Money $money;

    /**
     * @param Money $money
     */
    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    /**
     * @return void
     */
    public function setToZero(): void
    {
        $this->money->updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'count' => 0
        ]);
    }

    /**
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        $this->money->updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'count' => $value
        ]);
    }
}
