<?php

namespace App\Traits;

use App\DTO\ResponseData;
use App\Enums\MessageCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ResponseTrait
 * @package App\Traits
 */
trait ResponseDataTrait
{
    /**
     * @param $data
     * @return ResponseData
     */
    public function dataSuccess($data = null): ResponseData
    {
        return new ResponseData(Response::HTTP_OK, MessageCode::SUCCESS, $data);
    }


    /**
     * @param $data
     * @return ResponseData
     */
    public function dataCreateSuccess($data = null): ResponseData
    {
        return new ResponseData(Response::HTTP_CREATED, MessageCode::SUCCESS, $data);
    }

    /**
     * @return ResponseData
     */
    public function dataNoContent(): ResponseData
    {
        return new ResponseData(Response::HTTP_NO_CONTENT, MessageCode::SUCCESS, null);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataBadRequest($data = null, string $messages = MessageCode::BAD_REQUEST): ResponseData
    {
        return new ResponseData(Response::HTTP_BAD_REQUEST, $messages, $data);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataUnprocessableEntity($data = null, string $messages = MessageCode::ERROR): ResponseData
    {
        return new ResponseData(Response::HTTP_UNPROCESSABLE_ENTITY, $messages, $data);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataNotFound($data = null, string $messages = MessageCode::NOT_FOUND): ResponseData
    {
        return new ResponseData(Response::HTTP_NOT_FOUND, $messages, $data);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataForbidden($data = null, string $messages = MessageCode::FORBIDDEN): ResponseData
    {
        return new ResponseData(Response::HTTP_FORBIDDEN, $messages, $data);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataUnauthorized($data = null, string $messages = MessageCode::UNAUTHORIZED): ResponseData
    {
        return new ResponseData(Response::HTTP_UNAUTHORIZED, $messages, $data);
    }

    /**
     * @param $data
     * @param string $messages
     * @return ResponseData
     */
    public function dataInternalServerError($data = null, string $messages = MessageCode::INTERNAL_SERVER_ERROR): ResponseData
    {
        return new ResponseData(Response::HTTP_INTERNAL_SERVER_ERROR, $messages, $data);
    }
}
