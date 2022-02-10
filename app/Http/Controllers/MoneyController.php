<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Money::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMoneyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->moneys()
            ->updateOrCreate([
                'user_id' => auth()->user()->id
            ], [
                'count' => rand(1, 10)
            ]);

        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        auth()->user()->moneys()
            ->updateOrCreate([
                'user_id' => auth()->user()->id
            ], [
                'count' => 0
            ]);

        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function convert(Request $request)
    {
        $currentMoneys = auth()->user()->moneys->count;
        $currentPoints = auth()->user()->points->count;

        auth()->user()->points()
            ->updateOrCreate([
                'user_id' => auth()->user()->id
            ], [
                'count' =>  $currentPoints + $currentMoneys
            ]);

        auth()->user()->moneys()
            ->updateOrCreate([
                'user_id' => auth()->user()->id
            ], [
                'count' => 0
            ]);

        return redirect()->route('dashboard');
    }
}
