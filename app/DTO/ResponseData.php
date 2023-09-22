<?php

namespace App\DTO;

use App\Enums\MessageCode;
use Illuminate\Database\Eloquent\Collection;

class ResponseData
{
    public function __construct(
        public readonly int                   $statusCode,
        public readonly string|MessageCode    $message,
        public readonly array|Collection|null $data
    )
    {
    }

    /**
     * Get the value of message
     *
     * @return string|MessageCode
     */
    public function getMessage(): string|MessageCode
    {
        return $this->message;
    }

    /**
     * Get the value of data
     *
     * @return array|Collection|null
     */
    public function getData(): array|Collection|null
    {
        return $this->data;
    }

    /**
     * Get the value of statusCode
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }


    /**
     * Get array all attribute
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'message' => $this->message,
            'status_code' => $this->statusCode
        ];
    }


}
