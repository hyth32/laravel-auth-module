<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Actions\Auth\RegisterUser;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUser $action): JsonResponse
    {
        return response()->json(
            $action->handle($request->validated()),
        );
    }
}
