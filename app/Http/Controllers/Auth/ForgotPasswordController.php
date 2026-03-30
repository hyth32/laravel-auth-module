<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Actions\Auth\ForgotPassword;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request, ForgotPassword $action): Response
    {
        $action->handle($request->validated('email'));

        return response()->noContent();
    }
}
