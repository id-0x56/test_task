<?php

namespace App\Http\Controllers;

use App\Actions\MoneyActions;
use App\Actions\PointActions;
use App\Actions\SettingActions;
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
     * @var SettingActions
     */
    private SettingActions $settingActions;

    /**
     * @param MoneyActions $moneyActions
     * @param PointActions $pointActions
     * @param SettingActions $settingActions
     */
    public function __construct(MoneyActions $moneyActions, PointActions $pointActions, SettingActions $settingActions)
    {
        $this->moneyActions = $moneyActions;
        $this->pointActions = $pointActions;
        $this->settingActions = $settingActions;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $currentMoneys = auth()->user()->moneys->count ?? 0;
        $currentMoneys += rand($this->settingActions->getParams()->min_money, $this->settingActions->getParams()->max_money);

        $this->moneyActions->setValue($currentMoneys);

        return redirect()->route('dashboard');
    }

    /**
     * @param Bank $bank
     * @return RedirectResponse
     */
    public function withdraw(Bank $bank): RedirectResponse
    {
        $currentMoneys = auth()->user()->moneys->count ?? 0;

        if ($currentMoneys > 0) {
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
        $currentMoneys = auth()->user()->moneys->count ?? 0;
        $currentPoints = auth()->user()->points->count ?? 0;

        if ($currentMoneys > 0) {
            $this->pointActions->setValue($currentPoints + ($currentMoneys * $this->settingActions->getParams()->conversion_rate));
            $this->moneyActions->setToZero();
        }

        return redirect()->route('dashboard');
    }
}
