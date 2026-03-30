<?php

namespace App\Services;

use App\Models\PersonalAccessToken;
use App\Models\User;
use DateTimeInterface;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;

class AuthTokenService
{
    public function issuePair(User $user): array
    {
        $pairId = (string) Str::uuid();

        $accessToken = $this->createToken(
            user: $user,
            name: 'access-token',
            abilities: [PersonalAccessToken::TYPE_ACCESS],
            type: PersonalAccessToken::TYPE_ACCESS,
            pairId: $pairId,
            expiresAt: now()->addMinutes(config('auth.tokens.access_ttl', 15)),
        );

        $refreshToken = $this->createToken(
            user: $user,
            name: 'refresh-token',
            abilities: [PersonalAccessToken::TYPE_REFRESH],
            type: PersonalAccessToken::TYPE_REFRESH,
            pairId: $pairId,
            expiresAt: now()->addMinutes(config('auth.tokens.refresh_ttl', 43200)),
        );

        return [
            'access_token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }

    public function rotatePair(PersonalAccessToken $refreshToken): array
    {
        $user = $refreshToken->tokenable;

        $this->revokePair($refreshToken);

        return $this->issuePair($user);
    }

    public function revokePair(PersonalAccessToken $token): void
    {
        if ($token->pair_id === null) {
            $token->delete();

            return;
        }

        PersonalAccessToken::query()
            ->where('tokenable_type', $token->tokenable_type)
            ->where('tokenable_id', $token->tokenable_id)
            ->where('pair_id', $token->pair_id)
            ->delete();
    }

    public function revokeToken(PersonalAccessToken $token): void
    {
        $token->delete();
    }

    private function createToken(
        User $user,
        string $name,
        array $abilities,
        string $type,
        string $pairId,
        ?DateTimeInterface $expiresAt = null,
    ): NewAccessToken {
        $plainTextToken = $user->generateTokenString();

        /** @var PersonalAccessToken $token */
        $token = $user->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'type' => $type,
            'pair_id' => $pairId,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }
}
