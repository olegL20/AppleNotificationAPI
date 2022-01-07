<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UserService
{
    public function attachToken(int $userId, array $scope): void
    {
        User::find($userId)->createToken($userId, $scope);
    }

    public function revokeTokens(int $userId): void
    {
        User::find($userId)->tokens()->delete();
    }
}
