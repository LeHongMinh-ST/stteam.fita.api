<?php

namespace App\Http\Middleware;

use App\DTO\ResponseData;
use App\Enums\MessageCode;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class PermissionUser
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param $namePermission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $namePermission): mixed
    {
        try {
            $user = auth()->user();
            $isSuperAdmin = $user->is_super_admin;
            if ($isSuperAdmin) {
                return $next($request);
            }

            $role = Role::find($user->role_id);
            if (!$role) {

                return $this->responseJson(new ResponseData(
                    Response::HTTP_FORBIDDEN,
                    MessageCode::FORBIDDEN,
                    null
                ));
            }
            if ($role->permissions) {
                $isPermission = $this->hasPermission($role, $namePermission);
                if ($isPermission) {
                    return $next($request);
                }
            }

            return $this->responseJson(new ResponseData(
                Response::HTTP_FORBIDDEN,
                MessageCode::FORBIDDEN,
                null
            ));
        } catch (Throwable $e) {

            Log::error(__METHOD__);
            Log::error($e->getMessage());

            return $this->responseJson(new ResponseData(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                MessageCode::INTERNAL_SERVER_ERROR,
                null
            ));
        }

    }

    private function hasPermission($role, $codePermission)
    {
        $idPermission = Permission::where('code', $codePermission)->first();
        if ($idPermission)
            return $role->permissions->contains($idPermission->id);
        return false;
    }
}
