<?php

namespace MizterFrek\LaravelApiResponser;

use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    use \MizterFrek\LaravelApiResponser\Traits\ApiResponser;

    public function success(mixed $data = null, int $status = Response::HTTP_OK, string $message = 'OK')
    {
        return $this->successResponse($data, $status, $message);
    }

    public function error(int $status = Response::HTTP_INTERNAL_SERVER_ERROR, string|null $message = null, array|null $errors = null)
    {
        return $this->errorResponse($status, $message, $errors);
    }

    public function notFound(string|null $message = null)
    {
        return $this->notFoundResponse($message);
    }

    public function noContent()
    {
        return $this->noContentResponse();
    }

    public function unauthorized(string|null $message = null)
    {
        return $this->unauthorizedResponse($message);
    }
}