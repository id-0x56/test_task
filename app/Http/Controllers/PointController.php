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
        $currentPointCount = auth()->user()->points->count ?? 0;
        $currentPointCount += rand($this->settingActions->getParams()->min_point, $this->settingActions->getParams()->max_point);

        $this->pointActions->setValue($currentPointCount);

        return redirect()->route('dashboard');
    }
}
