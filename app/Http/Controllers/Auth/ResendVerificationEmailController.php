<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendVerificationEmailRequest;
use App\Actions\Auth\ResendVerificationEmail;
use Illuminate\Http\Response;

class ResendVerificationEmailController extends Controller
{
    public function __invoke(ResendVerificationEmailRequest $request, ResendVerificationEmail $action): Response
    {
        $action->handle($request->user());

        return response()->noContent();
    }
}
