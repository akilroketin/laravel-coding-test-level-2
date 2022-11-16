<?php

namespace App\Http\Services\Searches\Filters\Users;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Services\Searches\Contracts\FilterContract;
use App\Http\Services\Searches\Filters\Sort;
use App\Models\User;

class SortUser extends Sort
{
    /** @var string */
    protected $defaultSortField = 'id';

    // /** Editable */
    // public function classes(): array
    // {
    //     return [
    //         new User(),
    //     ];
    // }

    public function __construct(){
        parent::__construct(new User());
    }

    // /**
    //  * @return mixed
    //  */
    // public function handle(Builder $query, Closure $next)
    // {
    //     $sortField = request('sort_field', $this->defaultSortField);
    //     $sortOrder = request('sort_order', 'asc');

    //     $isSortAvailable = $this->isSortFieldAvailable($sortField);

    //     if ($isSortAvailable) {
    //         $query->orderBy($sortField, $sortOrder);
    //     }

    //     return $next($query);
    // }

    // protected function isSortFieldAvailable(string $sort): bool
    // {
    //     $fillable = $this->getAllFillable();

    //     return in_array($sort, $fillable);
    // }

    // protected function getAllFillable(): array
    // {
    //     $classes = $this->classes();

    //     $fillable = [];

    //     foreach ($classes as $class) {
    //         $keys = $class->getTable();

    //         foreach ($class->getFillable() as $fill) {
    //             $fillable[] = $keys . '.' . $fill;
    //         }
    //     }

    //     return $fillable;
    // }
}
