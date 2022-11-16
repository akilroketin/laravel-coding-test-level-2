<?php

namespace App\Http\Repositories\Contracts;

interface TaskContract
{
    public function createTask($attributes);
    public function updateTask($attributes, $id);
    public function createOrUpdateTask($attributes, $id);
    public function showTask($id);
    public function deleteTask($id);
}
