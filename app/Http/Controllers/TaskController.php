<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Contracts\TaskContract;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\Searches\TaskSearch;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $repository;

    public function __construct(TaskContract $repository)
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
        $factory = app()->make(TaskSearch::class);
        $data = $factory->apply()->paginate(request('per_page', 10));
        return TaskResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $data = $this->repository->createTask($request->all());
        return new TaskResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repository->showTask($id);
        return new TaskResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateTaskRequest $request, $id)
    {
        $data = $this->repository->updateTask($request->all(), $id);
        return new TaskResource($data);
    }

    /**
     * Update the specified resource idempotent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $this->repository->createOrUpdateTask($request->all(), $id);
        return new TaskResource($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->deleteTask($id);
    }
}
