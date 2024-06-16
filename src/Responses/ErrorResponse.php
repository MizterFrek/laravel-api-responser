<?php

namespace MizterFrek\LaravelApiResponser\Responses;

use MizterFrek\LaravelApiResponser\Contracts\Classes\Response as ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends ApiResponse
{
    public function __construct(int $status = Response::HTTP_INTERNAL_SERVER_ERROR, string|null $message = null, array|null $errors = null)
    {
        $this->errorJsonStructure($status);

        if ($message) {
            $this->addDetailFieldToResult($message);
        } 

        if ($errors) {
            $this->addErrorFieldToResult($errors);
        } 

        parent::__construct($status, self::HEADERS);
    }

    public static function make(int $status = Response::HTTP_INTERNAL_SERVER_ERROR, string|null $message = null, array|null $errors = null)
    {
        return new self($status, $message, $errors);
    }
    
    protected function errorJsonStructure(int $code): void
    {
        $this->body = [
            'message' => Response::$statusTexts[$code],
            'code' => $code,
        ];
    }

    protected function addErrorFieldToResult(array $errors): void
    {
        $body = $this->body;
        $body['errors'] = $errors;
        $this->body = $body;
    }
    
    protected function addDetailFieldToResult(string $detail): void
    {
        $body = $this->body;
        $body['detail'] = $detail;
        $this->body = $body;
    }
}