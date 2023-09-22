<?php

namespace App\Enums;

enum MessageCode: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case NOT_FOUND = 'not_found';
    case UNAUTHORIZED = 'unauthorized';
    case VALIDATION_ERROR = 'validation_error';
    case UNPROCESSABLE_ENTITY = 'unprocessable_entity';
    case FORBIDDEN = 'forbidden';
    case INTERNAL_SERVER_ERROR = 'internal_server_error';
    case BAD_REQUEST = 'bad_request';
}
