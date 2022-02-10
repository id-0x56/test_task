<?php

namespace App\Services\Interfaces;


use Illuminate\Http\Client\Response;

interface Bank
{
    /**
     * @param int $count
     * @return Response
     */
    public function deposit(int $count): Response;
}
