<?php

namespace App\Services\Banks;

use App\Services\Interfaces\Bank;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BlueBank implements Bank
{
    /**
     * @param int $count
     * @return Response
     */
    public function deposit(int $count): Response
    {
        $response = Http::get('https://api.00x56.com/api/locations');

        return $response;
    }
}
