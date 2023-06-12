<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomTokenProvider implements UserProvider
{

    public function retrieveByToken($identifier, $token)
    {
        $token = UserToken::where('access_token', $token)->first();

        abort_if(!isset($token), 401, 'Invalid token');

        return $token->owner;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Implement logic to update the remember token (if applicable)
    }

    // Implement other required methods such as retrieveByCredentials(), validateCredentials(), etc.
    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }


    public function retrieveById($identifier)
    {
        // Implement logic to retrieve user by identifier (e.g., user ID)
    }
}
