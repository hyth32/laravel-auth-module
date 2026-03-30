<?php

namespace App\Actions\Auth;

use Laravel\Sanctum\PersonalAccessToken;

class RefreshTokenPair
{
    public function handle(PersonalAccessToken $token): array
    {
        return [];
    }
}
