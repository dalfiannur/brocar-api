<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function currentUser()
    {
        return response()->success([
            'data' => $service->paginate(1000)
        ]);
    }
}
