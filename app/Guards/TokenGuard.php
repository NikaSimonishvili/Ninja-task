<?php

namespace App\Guards;

use App\Models\User;
use App\Providers\CustomTokenProvider;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenGuard implements Guard
{

    use GuardHelpers;

    protected Request $request;
    protected $provider;

    public function __construct(CustomTokenProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    public function validate(array $credentials = [])
    {
        return $this->getRequestToken();
    }

    public function user()
    {
        $user = null;
        $token = $this->getRequestToken();

        if (!empty($token)) {
            $user = $this->provider->retrieveByToken(null, $token);
        }

        return $this->user = $user;
    }

    protected function getRequestToken(): array
    {
        $token = $this->request->bearerToken();

        if (!$token) {
            $token = $this->request->query('access_token');
        }

        abort_if(!isset($token), 401, 'Invalid token');

        return ['access_token' => $token];
    }
}
