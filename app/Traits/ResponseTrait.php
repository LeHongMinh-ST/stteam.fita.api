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
trait ResponseTrait
{
    /**
     * @param ResponseData $responseData
     * @return JsonResponse
     */
    public function responseJson(ResponseData $responseData): JsonResponse
    {
        return response()->json($responseData->toArray(), $responseData->getStatusCode());
    }
}
