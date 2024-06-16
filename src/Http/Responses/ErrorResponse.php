<?php

namespace MizterFrek\Http\Responses;

use Illuminate\Validation\ValidationException;
use MizterFrek\Contracts\Classes\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends ApiResponse
{
    public function __construct(string $message, int $status, array|null $errors = null)
    {
        $this->body = $this->errorJsonStructure($message, $status);

        if ($errors) {
            $this->addErrorFieldToResult($errors);
        } 

        parent::__construct($this->body, $status, self::HEADERS);
    }

    public static function make(string $message, int $status = 500, array|null $errors = null)
    {
        return new self($message, $status, $errors);
    }

    public static function fromValidator(ValidationException $exception)
    {
        return new self($exception->getMessage(), 422, $exception->validator->errors()->getMessages());
    }

    protected function errorJsonStructure(string $detail = '', int $code = 500): array
    {
        return [
            'message' => Response::$statusTexts[$code],
            'code' => $code,
            'detail' => $detail
        ];
    }

    protected function addErrorFieldToResult(array $errors): void
    {
        $body = $this->body;
        $body['errors'] = $errors;
        $this->body = $body;
    }
}