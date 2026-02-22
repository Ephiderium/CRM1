<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class NameFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->name)) {
            return $next($builder);
        }

        $key = $this->dto->name;
        $query = $builder->where('name', $key);

        return $next($query);
    }
}
