<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Transaction;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $transactions = Transaction::with('user')->paginate(5);

        return $this->successResponse([
            'transactions'  => TransactionResource::collection($transactions),
            'pagination'    => PaginationResource::make($transactions)
        ]);
    }
}
