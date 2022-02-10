<?php

namespace App\Actions;

use App\Models\Money;
use Illuminate\Support\Facades\Log;

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
     * @param int $value
     * @return void
     */
    public function setValue(int $value = 0): void
    {
        $user_id = $this->money->user_id ?? auth()->user()->id;
        $this->money->updateOrCreate(['user_id' => $user_id], [
            'user_id' => $user_id,
            'count' => $value
        ]);
    }
}
