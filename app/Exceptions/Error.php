<?php

namespace App\Exceptions;

use Exception;

class Error extends Exception
{
    public function __construct($status, $message, $fields = [])
    {
        parent::__construct();
        $this->status = $status;
        $this->message = $message;
        $this->fields = $fields;
    }

    public function render($request)
    {
        return response()->json([
            'status' => $this->status,
            'message' => $this->message,
            'fields' => $this->fields,
        ], $this->status);
    }
}
