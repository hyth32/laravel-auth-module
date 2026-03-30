<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\VerifyEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Illuminate\Http\Response;

class VerifyEmailController extends Controller
{
    public function __invoke(VerifyEmailRequest $request, VerifyEmail $action): Response
    {
        $action->handle($request->user(), $request->validated());

        return response()->noContent();
    }
}
