<?php

namespace App\Http\Services\Searches;

use App\Http\Services\Searches\Filters\Tasks\Search;
use App\Http\Services\Searches\Filters\Tasks\SortTask;
use App\Http\Services\Searches\HttpSearch;
use App\Models\Task;

class TaskSearch extends HttpSearch
{

	protected function passable()
	{
		return Task::query();
	}

	protected function filters(): array
	{
		return [
			// SortTask::class,
			// Search::class,
		];
	}

	protected function thenReturn($taskSearch)
	{
		return $taskSearch;
	}
}
