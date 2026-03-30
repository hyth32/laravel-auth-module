<?php

namespace App\Actions\Auth;

use App\Models\PersonalAccessToken;
use App\Services\AuthTokenService;

class RefreshTokenPair
{
    public function __construct(
        private readonly AuthTokenService $tokenService,
    ) {}

    public function handle(PersonalAccessToken $token): array
    {
        return $this->tokenService->rotatePair($token);
    }
}
