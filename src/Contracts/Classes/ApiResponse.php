<?php

namespace MizterFrek\Contracts\Classes;

use Illuminate\Http\JsonResponse;
use MizterFrek\Contracts\Interfaces\ApiResponser;

abstract class ApiResponse extends JsonResponse implements ApiResponser
{
    protected array $body;

    public function __construct($data = null, $status = 200)
    {
        parent::__construct($data, $status, self::HEADERS);
    }
}