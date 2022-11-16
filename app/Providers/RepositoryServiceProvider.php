<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Contracts\ProjectContract;
use App\Http\Repositories\Contracts\TaskContract;
use App\Http\Repositories\Contracts\UserContract;
use App\Http\Repositories\ProjectRepository;
use App\Http\Repositories\TaskRepository;
use App\Http\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryContract::class, BaseRepository::class);

        $this->app->bind(UserContract::class, UserRepository::class);

        $this->app->bind(ProjectContract::class, ProjectRepository::class);

        $this->app->bind(TaskContract::class, TaskRepository::class);
    }
}
