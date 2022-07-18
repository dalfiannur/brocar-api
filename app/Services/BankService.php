<?php

namespace App\Services;

use App\Models\Bank;

class BankService {
    public function paginate(int $perPage) {
        return Bank::query()->paginate($perPage);
    }
}
