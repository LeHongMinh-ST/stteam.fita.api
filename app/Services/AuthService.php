<?php

namespace App\Services;

use App\DTO\ResponseData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthService extends BaseService
{
    public function login(array $data = []): ResponseData
    {
        try {
            $credentials = [
                $this->username($data['user_name']) => $data['user_name'],
                'password' => $data['password']
            ];

            if (!auth()->attempt($credentials)) {
                return $this->dataUnauthorized();
            }

            $user = auth()->user();
            $tokenResult = $user->createToken('access_token');

            $token = $tokenResult->token;
            if (!empty($data['remember_me'])) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            $token->save();

            return $this->dataSuccess([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError(trans('messages.api.server_error'));
        }
    }

    private function username($userName): string
    {
        return filter_var($userName, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
    }

    public function getUser(): ResponseData
    {
        try {
            $user = auth()->user();
            if (empty($user)) {
                return $this->dataUnauthorized();
            }
            return $this->dataSuccess($user);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }


    public function logout(): ResponseData
    {
        $token = auth()->user()->token();
        $token->revoke();
        return $this->dataNoContent();
    }
}
