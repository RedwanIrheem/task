<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static $data;
    public function __construct()
    {
        self::$data['key'] = "0aad3f53-e918-4ea5-b1fc-08a72670bc9e";
        self::$data['account'] = "1499700995.4461";
    }
}
