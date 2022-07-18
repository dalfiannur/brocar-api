<?php

namespace App\Traits;

use Illuminate\Http\Request;

Trait RestTrait {
    public function isApiCall(Request $request) {
        return strpos($request->getUri(), '/api/v') !== false;
    }
}
