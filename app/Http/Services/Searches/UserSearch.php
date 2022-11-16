<?php

namespace App\Http\Services\Searches;

use App\Http\Services\Searches\Filters\Users\FilterRole;
use App\Http\Services\Searches\Filters\Users\Search;
use App\Http\Services\Searches\Filters\Users\SortUser;
use App\Http\Services\Searches\HttpSearch;
use App\Models\User;

class UserSearch extends HttpSearch
{

	protected function passable()
	{
		return User::query();
	}

	protected function filters(): array
	{
		return [
			SortUser::class,
			FilterRole::class,
			Search::class,
		];
	}

	protected function thenReturn($userSearch)
	{
		return $userSearch;
	}
}
