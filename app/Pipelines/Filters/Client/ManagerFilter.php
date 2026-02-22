<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ManagerFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->manager_id)) {
            return $next($builder);
        }

        $key = $this->dto->manager_id;
        $query = $builder->where('manager_id', $key);

        return $next($query);
    }
}
