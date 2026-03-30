<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public const TYPE_ACCESS = 'access';

    public const TYPE_REFRESH = 'refresh';

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'type',
        'pair_id',
        'expires_at',
    ];

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'pair_id' => 'string',
    ];
}
