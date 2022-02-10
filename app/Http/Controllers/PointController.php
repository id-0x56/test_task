<?php

namespace App\Http\Controllers;

use App\Actions\PointActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * @var PointActions
     */
    private PointActions $pointActions;

    /**
     * @param PointActions $pointActions
     */
    public function __construct(PointActions $pointActions)
    {
        $this->pointActions = $pointActions;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->pointActions->setValue(rand(1, 10));

        return redirect()->route('dashboard');
    }
}
