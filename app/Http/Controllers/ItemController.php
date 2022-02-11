<?php

namespace App\Http\Controllers;

use App\Actions\ItemActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $totalItem = $this->itemActions->getRandItem();

        if (!is_null($totalItem)) {
            $this->itemActions->attachItemToUser($totalItem->id);

            $totalItem->count--;
            $totalItem->save();
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function update($id): RedirectResponse
    {
        $totalItem = $this->itemActions->getItemById($id);

        if (!is_null($totalItem)) {
            $currentItem = $this->itemActions->getNotSentItemById($totalItem->id);

            $currentItem->is_send = true;
            $currentItem->save();
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $totalItem = $this->itemActions->getItemById($id);

        if (!is_null($totalItem)) {
            $currentItem = $this->itemActions->getNotSentItemById($totalItem->id);

            if (!is_null($currentItem)) {
                $currentItem->delete();

                $totalItem->count++;
                $totalItem->save();
            }
        }

        return redirect()->route('dashboard');
    }
}
