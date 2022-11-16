<?php

namespace App\Http\Services\Searches;

use App\Http\Services\Searches\Filters\Projects\Search;
use App\Http\Services\Searches\Filters\Projects\SortProject;
use App\Http\Services\Searches\HttpSearch;
use App\Models\Project;

class ProjectSearch extends HttpSearch
{

	protected function passable()
	{
		return Project::query();
	}

	protected function filters(): array
	{
		return [
			// SortProject::class,
			// Search::class,
		];
	}

	protected function thenReturn($projectSearch)
	{
		return $projectSearch;
	}
}