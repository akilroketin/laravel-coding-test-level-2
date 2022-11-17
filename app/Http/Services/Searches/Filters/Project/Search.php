<?php

namespace App\Http\Services\Searches\Filters\Project;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Services\Searches\Contracts\FilterContract;

class Search implements FilterContract
{
    /** @var string|null */
    protected $q;

    /**
     * @param string|null $q
     * @return void
     */
    public function __construct($q)
    {
        $this->q = $q;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()) {
            return $next($query);
        }

        $query->where('name', 'LIKE', '%' . $this->q . '%');



        return $next($query);
    }

    /**
     * Get q keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->q) {
            return $this->q;
        }

        $this->q = request('q', null);

        return request('q');
    }
}
