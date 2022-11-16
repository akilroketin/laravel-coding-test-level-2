<?php

namespace App\Http\Services\Searches\Filters;

use Closure;
use App\Models\TestExample;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Services\Searches\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Model;

class Sort implements FilterContract
{
    /** @var string */
    protected $defaultSortField = 'id';

    protected Model $model;
    /** Editable */
    public function classes(): array
    {
        return [
            $this->model
        ];
    }

    public function __construct(Model $classes)
    {
        $this->model = $classes;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        $sortField = request('sort_field', $this->defaultSortField);
        $sortOrder = request('sort_order', 'asc');

        $isSortAvailable = $this->isSortFieldAvailable($sortField);

        if ($isSortAvailable) {
            $query->orderBy($sortField, $sortOrder);
        }

        return $next($query);
    }

    protected function isSortFieldAvailable(string $sort): bool
    {
        $fillable = $this->getAllFillable();

        return in_array($sort, $fillable);
    }

    protected function getAllFillable(): array
    {
        $classes = $this->classes();

        $fillable = [];

        foreach ($classes as $class) {
            $keys = $class->getTable();

            foreach ($class->getFillable() as $fill) {
                $fillable[] = $keys . '.' . $fill;
            }
        }

        return $fillable;
    }
}
