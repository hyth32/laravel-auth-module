<?php

namespace App\Actions\Auth;

use Laravel\Sanctum\PersonalAccessToken;

class LogoutUser
{
    public function handle(PersonalAccessToken $token): void
    {
        //
    }
}
