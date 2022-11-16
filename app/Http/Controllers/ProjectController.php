<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Contracts\ProjectContract;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Services\Searches\ProjectSearch;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $repository;

    public function __construct(ProjectContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factory = app()->make(ProjectSearch::class);
        $data = $factory->apply()->paginate(request('per_page', 10));
        return ProjectResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $data = $this->repository->createProject($request->all());
        return new ProjectResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repository->showProject($id);
        return new ProjectResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateProjectRequest $request, $id)
    {
        $data = $this->repository->updateProject($request->all(), $id);
        return new ProjectResource($data);
    }

    /**
     * Update the specified resource idempotent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $data = $this->repository->createOrUpdateProject($request->all(), $id);
        return new ProjectResource($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->deleteProject($id);
    }
}
