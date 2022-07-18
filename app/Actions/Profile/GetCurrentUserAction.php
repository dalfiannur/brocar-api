<?php

namespace App\Actions\Profile;

use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCurrentUserAction
{
    use AsAction;

    public function handle()
    {
        dd(Auth::user());
        return Auth::user();
    }

    public function asController()
    {
        return response()->success($this->handle());
    }
}
