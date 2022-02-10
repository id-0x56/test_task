<?php

namespace App\Http\Controllers;

use App\Actions\PointActions;
use App\Actions\SettingActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * @var PointActions
     */
    private PointActions $pointActions;

    /**
     * @var SettingActions
     */
    private SettingActions $settingActions;

    /**
     * @param PointActions $pointActions
     */
    public function __construct(PointActions $pointActions, SettingActions $settingActions)
    {
        $this->pointActions = $pointActions;
        $this->settingActions = $settingActions;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $currentPoints = auth()->user()->points->count ?? 0;
        $currentPoints += rand($this->settingActions->getParams()->min_point, $this->settingActions->getParams()->max_point);

        $this->pointActions->setValue($currentPoints);

        return redirect()->route('dashboard');
    }
}
