<?php

namespace App\Actions;

use App\Models\Item;
use App\Models\TotalItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * @return Model|null
     */
    public function getRandItem(): Model | null
    {
        return TotalItem::query()
            ->where('count', '>', 0)
            ->inRandomOrder()
            ->first();
    }

    /**
     * @param int $id
     * @return void
     */
    public function attachItemToUser(int $id): void
    {
        Item::create([
            'user_id' => auth()->user()->id,
            'item_id' => $id,
        ]);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function getItemById(int $id): Model | null
    {
        return auth()->user()->items
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function getNotSentItemById(int $id): Model | null
    {
        return Item::query()
            ->where('item_id', $id)
            ->where('user_id', auth()->user()->id)
            ->where('is_send', '!=', true)
            ->first();
    }

    /**
     * @return Model|null
     */
    public function getNotSentAllItems(): Collection | null
    {
        return auth()->user()
            ->items()->where('is_send', '!=', true)
            ->orderBy('item_id')
            ->get();
    }
}
