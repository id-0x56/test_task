<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointRequest;
use App\Models\Point;

class PointController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Point::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePointRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointRequest $request)
    {
        auth()->user()->points()
            ->updateOrCreate([
                'user_id' => auth()->user()->id
            ], [
                'count' => rand(1, 10)
            ]);

        return redirect()->route('dashboard');
    }
}
