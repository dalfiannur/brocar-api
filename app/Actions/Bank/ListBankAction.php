<?php

namespace App\Actions\Bank;

use App\Services\BankService;
use Lorisleiva\Actions\Concerns\AsAction;

class ListBankAction
{
    use AsAction;

    public function handle(BankService $service)
    {
        return $service->paginate(1000);
    }

    public function asController()
    {
        return response()->success(
            $this->handle(new BankService())
        );
    }
}
