<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getToken($role = '') {
        $loginApiLink = '/api/login';
        $return = array();
        if ($role === 'admin') {
            $return = $this->post($loginApiLink, [
                "username" => "admin",
                "password" => "12345678",
            ]);
        }
        if ($role === 'product') {
            $return = $this->post($loginApiLink, [
                "username" => "product_owner",
                "password" => "12345678",
            ]);
        }
        if ($role === 'member') {
            $return = $this->post($loginApiLink, [
                "username" => "member1",
                "password" => "12345678",
            ]);
        }

        return $return->content();
    }
}
