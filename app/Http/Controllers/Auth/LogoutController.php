<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogoutRequest;
use App\Actions\Auth\LogoutUser;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function __invoke(LogoutRequest $request, LogoutUser $action): Response
    {
        $action->handle($request->user()->currentAccessToken());

        return response()->noContent();
    }
}
