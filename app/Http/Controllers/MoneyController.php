<?php

namespace App\Http\Controllers;

use App\Actions\MoneyActions;
use App\Actions\PointActions;
use App\Actions\SettingActions;
use App\Actions\TotalMoneyActions;
use App\Jobs\BankRequestJob;
use App\Services\Interfaces\Bank;
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
        $currentMoneyCount = auth()->user()->moneys->count ?? 0;

        $moneyPresent = rand($this->settingActions->getParams()->min_money, $this->settingActions->getParams()->max_money);
        $currentMoneyCount += $moneyPresent;

        $totalMoneyActions = new TotalMoneyActions();
        $totalMoneyActions->setValue($totalMoneyActions->getValue() - $moneyPresent);

        $this->moneyActions->setValue($currentMoneyCount);

        return redirect()->route('dashboard');
    }

    /**
     * @param Bank $bank
     * @return RedirectResponse
     */
    public function withdraw(Bank $bank): RedirectResponse
    {
        $currentMoneys = auth()->user()->moneys;

        if (!is_null($currentMoneys) && $currentMoneys->count > 0) {
            BankRequestJob::dispatch($bank, $currentMoneys);
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function convert(Request $request): RedirectResponse
    {
        $currentMoneys = auth()->user()->moneys;
        $currentPointCount = auth()->user()->points->count ?? 0;

        if (!is_null($currentMoneys) && $currentMoneys->count > 0) {
            $this->pointActions->setValue($currentPointCount + ($currentMoneys->count * $this->settingActions->getParams()->conversion_rate));
            $this->moneyActions->setValue();
        }

        return redirect()->route('dashboard');
    }
}
