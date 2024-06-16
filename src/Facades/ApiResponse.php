<?php

namespace MizterFrek\LaravelApiResponser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse success(mixed $data, int $status, string $message)
 * @method static \Illuminate\Http\JsonResponse error(string $message, int $status, array|null $errors)
 * @method static \Illuminate\Http\JsonResponse notFound(string $message)
 * @method static \Illuminate\Http\JsonResponse noContent()
 * @method static \Illuminate\Http\JsonResponse unauthorized(string $message)
 * 
 * @see \AgendeDePrensa\Classes\Attributes
 */
class ApiResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mizterfrek.api-response';
    }
}