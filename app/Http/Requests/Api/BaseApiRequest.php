<?php

namespace App\Http\Requests\Api;

use App\DTO\ResponseData;
use App\Enums\MessageCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class BaseApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $responseData = new ResponseData(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            MessageCode::ERROR,
            ['errors' => $errors]
        );

        throw new HttpResponseException(response()->json(
            $responseData->toArray(),
            $responseData->getStatusCode()
        ));
    }
}
