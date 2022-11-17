<?php

namespace App\Http\Services\Searches\Filters\Users;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Services\Searches\Contracts\FilterContract;

class FilterRole implements FilterContract
{
    /** @var array|null */
    protected $filter;

    /**
     * @param string|null $filter
     * @return void
     */
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()) {
            return $next($query);
        }

        $filters = $this->filter;


        $query->where(function ($query) use ($filters) {
            $count = 0;
            foreach ($filters as $filter) {
                if ($count == 0) {
                    $query->where("role", $filter);
                    $count++;
                } else {
                    $query->orWhere("role", $filter);
                }
            }
        });

        return $next($query);
    }

    /**
     * Get filter keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->filter) {
            $array = is_array($this->filter) ? $this->filter : [$this->filter];
            $this->filter = $array;
            return $array;
        }

        $this->filter = request('roles', []);

        return request('roles');
    }
}
