<?php

namespace App\Http\Controllers;

use App\Actions\MoneyActions;
use App\Actions\PointActions;
use App\Services\Interfaces\Bank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    /**
     * @var MoneyActions
     */
    private MoneyActions $moneyActions;

    /**
     * @var PointActions
     */
    private PointActions $pointActions;

    /**
     * @param MoneyActions $moneyActions
     * @param PointActions $pointActions
     */
    public function __construct(MoneyActions $moneyActions, PointActions $pointActions)
    {
        $this->moneyActions = $moneyActions;
        $this->pointActions = $pointActions;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->moneyActions->setValue(rand(1, 10));

        return redirect()->route('dashboard');
    }

    /**
     * @param Bank $bank
     * @return RedirectResponse
     */
    public function withdraw(Bank $bank): RedirectResponse
    {
        if (auth()->user()->moneys->count > 0) {
            if ($bank->deposit(auth()->user()->moneys->count)->status() == JsonResponse::HTTP_OK)
            {
                $this->moneyActions->setToZero();
            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function convert(Request $request): RedirectResponse
    {
        $currentMoneys = auth()->user()->moneys->count;
        $currentPoints = auth()->user()->points->count;

        $this->pointActions->setValue($currentPoints + $currentMoneys);
        $this->moneyActions->setToZero();

        return redirect()->route('dashboard');
    }
}
