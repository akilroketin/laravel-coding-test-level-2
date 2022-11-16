<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ProjectContract;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends BaseRepository implements ProjectContract
{
    protected $project;

    public function __construct(Project $project)
    {
        parent::__construct($project);
        $this->project = $project;
    }

    public function createProject($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $data = $this->store($attributes);

            return $data;
		});
    }

    public function updateProject($attributes, $id)
    {
        return DB::transaction(function () use ($attributes, $id) {
            $this->update($attributes, $id);

            $data = $this->project->find($id);

            return $data;
        });
    }

    public function createOrUpdateProject($attributes, $id)
    {
        $data = $this->project->find($id);
        if ($data !== null) {
            return $this->updateProject($attributes, $id);
        } else {
            return $this->createProject($attributes);
        }
    }

    public function showProject($id)
    {
        return $this->project->find($id);
    }

    public function deleteProject($id)
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

