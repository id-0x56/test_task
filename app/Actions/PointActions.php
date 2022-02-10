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
    public function setValue(int $value = 0): void
    {
        $user_id = $this->point->user_id ?? auth()->user()->id;
        $this->point->updateOrCreate(['user_id' => $user_id], [
            'user_id' => $user_id,
            'count' => $value
        ]);
    }
}
