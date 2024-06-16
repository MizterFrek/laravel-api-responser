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

    public function errorResponse(string $message, int $status, array|null $errors = null)
    {
        return ErrorResponse::make($message, $status, $errors);
    }

    public function notFoundResponse(string $message = 'Not Found')
    {
        return SuccessResponse::make(status: Response::HTTP_NOT_FOUND, message: $message);
    }

    public function noContentResponse()
    {
        return response()->noContent();
    }

    public function unauthorizedResponse(string $message = 'Unauthorized')
    {
        return ErrorResponse::make(status: Response::HTTP_UNAUTHORIZED, message: $message);
    }
}