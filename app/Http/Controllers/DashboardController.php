<?php

namespace App\Http\Controllers;

use App\Actions\ItemActions;

class DashboardController extends Controller
{
    /**
     * @var ItemActions
     */
    private ItemActions $itemActions;

    /**
     * @param ItemActions $itemActions
     */
    public function __construct(ItemActions $itemActions)
    {
        $this->itemActions = $itemActions;
    }

    public function index()
    {
        $points = auth()->user()->points ?? 0;
        $moneys = auth()->user()->moneys ?? 0;
        $items = $this->itemActions->getNotSentAllItems();

        return view('dashboard', compact(['points', 'moneys', 'items']));
    }
}
