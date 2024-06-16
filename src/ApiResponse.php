<?php

namespace MizterFrek\LaravelApiResponser;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    use \MizterFrek\LaravelApiResponser\Traits\ApiResponser;

    public function success(mixed $data = null, int $status = Response::HTTP_OK, string $message = 'OK')
    {
        return $this->successResponse($data, $status, $message);
    }

    public function error(string $message, int $status, array|null $errors = null)
    {
        return $this->errorResponse($message, $status, $errors);
    }

    public function notFound(string $message = 'Not Found')
    {
        return $this->notFoundResponse($message);
    }

    public function noContent()
    {
        return $this->noContentResponse();
    }

    public function unauthorized(string $message = 'Unauthorized')
    {
        return $this->unauthorizedResponse($message);
    }
}