<?php

namespace App\Exception;

use Exception;

class RecordNotFoundException extends Exception
{
    public function __construct(
        $message = "",
    ) {
        parent::__construct($message, 404);
    }
}