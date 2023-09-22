<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

class ResponseData
{
    public function __construct(
        public readonly int                   $statusCode,
        public readonly string                $message,
        public readonly array|Collection|null $data
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array|Collection|null
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }


    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'message' => $this->message,
            'status_code' => $this->statusCode
        ];
    }


}
