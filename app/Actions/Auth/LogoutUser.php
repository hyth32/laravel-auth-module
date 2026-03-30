<?php

namespace App\Actions\Auth;

use App\Models\PersonalAccessToken;
use App\Services\AuthTokenService;

class LogoutUser
{
    public function __construct(
        private readonly AuthTokenService $tokenService,
    ) {}

    public function handle(PersonalAccessToken $token): void
    {
        $this->tokenService->revokePair($token);
    }
}
