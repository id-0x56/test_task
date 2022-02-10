<?php

namespace App\Actions;

use App\Models\Point;

class PointActions
{
    /**
     * @var Point
     */
    private Point $point;

    /**
     * @param Point $point
     */
    public function __construct(Point $point)
    {
        $this->point = $point;
    }

    /**
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        $this->point->updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'count' => $value
        ]);
    }
}
