<?php

namespace App\Jobs;

use App\Actions\MoneyActions;
use App\Models\Money;
use App\Services\Interfaces\Bank;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BankRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Bank
     */
    protected Bank $bank;

    /**
     * @var Money
     */
    protected Money $money;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bank $bank, Money $money)
    {
        $this->bank = $bank;
        $this->money = $money;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = $this->bank->deposit($this->money->count);

        if ($response->status() == JsonResponse::HTTP_OK)
        {
            (new MoneyActions($this->money))->setValue();
            Log::alert($response->body());
        }
    }
}
