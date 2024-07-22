<?php

namespace App\Http\Controllers\Client;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    use ApiResponse;

    public function store(TransactionRequest $request)
    {
        $paymentUrl = auth('sanctum')->user()->makeTransaction($request->amount);

        return $this->successResponse([
            'paymentUrl' => $paymentUrl,
            'amount'     => $request->amount
        ]);
    }
}
