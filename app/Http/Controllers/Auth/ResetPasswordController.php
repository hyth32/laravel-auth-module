<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Actions\Auth\ResetPassword;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request, ResetPassword $action): Response
    {
        $action->handle($request->validated());

        return response()->noContent();
    }
}
