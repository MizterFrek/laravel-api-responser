<?php

namespace MizterFrek\Http\Responses;

use MizterFrek\Contracts\Classes\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponse extends ApiResponse
{

    public function __construct(mixed $data = null, int $status = 200, string|null $message = null)
    {
        $this->body = [ 
            'message' => $this->getMessageByStatus($status, $message), 
            'code' => $status 
        ];

        $this->appendDataInBody($data);

        parent::__construct($this->body, $status, self::HEADERS);
    }

    public static function make(mixed $data = null, int $status = 200, string|null $message = null)
    {
        return new self($data, $status, $message);
    }

    protected function getMessageByStatus(int $status, $message): string
    {
        return is_null($message)
            ? Response::$statusTexts[$status]
            : $message;
    }

    protected function appendDataInBody(mixed $data)
    {
        is_null($data) ?: $this->body['data'] = $data;
    }
}