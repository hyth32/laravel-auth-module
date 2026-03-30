<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RefreshTokenController extends Controller
{
    public function __invoke(): Response
    {
        return response()->noContent();
    }
}
