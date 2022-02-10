<?php

namespace App\Actions;

use App\Models\Item;

class ItemActions
{
    /**
     * @var Item
     */
    private Item $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        //
    }
}
