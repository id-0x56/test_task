<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        dump(
            __METHOD__,
            $request,
        );
        return redirect()->route('dashboard');
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        dump(
            __METHOD__,
        );
        return redirect()->route('dashboard');

    }

    /**
     * @param Item $item
     * @return RedirectResponse
     */
    public function destroy(Item $item): RedirectResponse
    {
        dump(
            __METHOD__,
        );
        return redirect()->route('dashboard');
    }
}
