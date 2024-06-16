<?php

namespace MizterFrek\LaravelApiResponser\Contracts\Classes;

use Illuminate\Http\JsonResponse;
use MizterFrek\LaravelApiResponser\Contracts\Interfaces\ApiResponser;

abstract class Response extends JsonResponse implements ApiResponser
{
    protected array $body;

    public function __construct($data = null, $status = 200)
    {
        parent::__construct($data, $status, self::HEADERS);
    }
}