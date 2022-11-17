<?php

namespace Tests\Traits;

use Error;

trait AuthCase
{
    public function getAccessToken(string $username, string $password)
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson(route('login'), [
            "username" => $username,
            "password" => $password,
        ]);

        if (!$response) {
            throw new Error('Login Failed', 400);
        }

        return $response;
    }
}
