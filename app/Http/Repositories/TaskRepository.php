<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\TaskContract;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepository extends BaseRepository implements TaskContract
{
    protected $task;

    public function __construct(Task $task)
    {
        parent::__construct($task);
        $this->task = $task;
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
            if((Auth::user())->hasRole('MEMBER')) {
                $data = $this->task->where('user_id', Auth::user()->id)->where('id', $id)->first();

                if ($data) {
                    return $this->task->where('user_id', Auth::user()->id)->where('id', $id)->update($attributes);
                }
            } else {

                $this->update($attributes, $id);

                $data = $this->task->find($id);

                return $data;
            }

            return null;
        });
    }

    public function createOrUpdateTask($attributes, $id)
    {
        $data = $this->task->find($id);
        if ($data !== null) {
            return $this->updateTask($attributes, $id);
        } else {
            return $this->createTask($attributes);
        }
    }

    public function showTask($id)
    {
        return $this->task->find($id);
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

