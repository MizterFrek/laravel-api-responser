<?php

namespace MizterFrek\LaravelApiResponser\Traits;

use MizterFrek\LaravelApiResponser\Responses\ErrorResponse;
use MizterFrek\LaravelApiResponser\Responses\SuccessResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponser 
{
    public function successResponse(mixed $data = null, int $status = Response::HTTP_OK, string $message = 'OK')
    {
        return SuccessResponse::make($data, $status, $message);
    }

    public function errorResponse(int $status, string|null $message = null, array|null $errors = null)
    {
        return ErrorResponse::make($status, $message, $errors);
    }

    public function notFoundResponse(string|null $message = null)
    {
        return ErrorResponse::make(Response::HTTP_NOT_FOUND, $message);
    }

    public function noContentResponse()
    {
        return response()->noContent();
    }

    public function unauthorizedResponse(string|null $message = null)
    {
        return ErrorResponse::make(Response::HTTP_UNAUTHORIZED, $message);
    }
}