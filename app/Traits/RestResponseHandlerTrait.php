<?php

namespace App\Traits;

use Illuminate\Support\MessageBag;

trait RestResponseHandlerTrait
{
    public function validationError(MessageBag $errors)
    {
        return [
            'status' => 422,
            'message' => 'Validation Error',
            'errors' => $errors
        ];
    }
}
