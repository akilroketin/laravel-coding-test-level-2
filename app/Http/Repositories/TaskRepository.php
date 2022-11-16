<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\TaskContract;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository extends BaseRepository implements TaskContract
{
    protected $project;

    public function __construct(Task $project)
    {
        parent::__construct($project);
        $this->project = $project;
    }

    public function createTask($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $data = $this->store($attributes);

            return $data;
		});
    }

    public function updateTask($attributes, $id)
    {
        return DB::transaction(function () use ($attributes, $id) {
            $this->update($attributes, $id);

            $data = $this->project->find($id);

            return $data;
        });
    }

    public function createOrUpdateTask($attributes, $id)
    {
        $data = $this->project->find($id);
        if ($data !== null) {
            return $this->updateTask($attributes, $id);
        } else {
            return $this->createTask($attributes);
        }
    }

    public function showTask($id)
    {
        return $this->project->find($id);
    }

    public function deleteTask($id)
    {
        $result = $this->delete($id);
        if (!$result) {
            return response([
                'message' => 'Not Found'
            ])
                ->setStatusCode(404);
        }

        return response()->json([
            'message' => "Delete Success"
        ], 200);
    }
}

