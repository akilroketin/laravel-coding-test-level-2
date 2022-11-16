<?php

namespace App\Http\Repositories\Contracts;

interface UserContract
{
    public function createUser($attributes);
    public function updateUser($attributes, $id);
    public function createOrUpdateUser($attributes, $id);
    public function showUser($id);
    public function deleteUser($id);
}
