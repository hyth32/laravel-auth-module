<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Actions\Auth\RefreshTokenPair;
use Illuminate\Http\JsonResponse;

class RefreshTokenController extends Controller
{
    public function __invoke(RefreshTokenRequest $request, RefreshTokenPair $action): JsonResponse
    {
        return response()->json(
            $action->handle($request->user()->currentAccessToken()),
        );
    }
}
