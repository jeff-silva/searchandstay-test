<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\Error;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="Search and Stay Test", version="0.1")
 * @OA\PathItem(path="/api")
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function error($status, $message, $fields = [])
    {
        throw new Error($status, $message, $fields);
    }
}
