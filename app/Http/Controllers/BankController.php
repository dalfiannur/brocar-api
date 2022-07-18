<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bank\CreateRequest;
use App\Models\Bank;
use App\Services\BankService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(BankService $service)
    {
        return response()->success([
            'data' => $service->paginate(1000)
        ]);
    }
}
