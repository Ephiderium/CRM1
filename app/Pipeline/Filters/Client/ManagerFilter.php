<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ManagerFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('manager_id'))) {
            return $next($builder);
        }

        $key = $this->request->validated('manager_id');
        $query = $builder->where('manager_id', $key);

        return $next($query);
    }
}
