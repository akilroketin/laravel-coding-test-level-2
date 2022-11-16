<?php

namespace App\Http\Repositories\Contracts;

interface ProjectContract
{
    public function createProject($attributes);
    public function updateProject($attributes, $id);
    public function createOrUpdateProject($attributes, $id);
    public function showProject($id);
    public function deleteProject($id);
}
