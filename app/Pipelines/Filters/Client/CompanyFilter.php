<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class CompanyFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->company)) {
            return $next($builder);
        }

        $key = $this->dto->company;
        $query = $builder->where('company', $key);

        return $next($query);
    }
}
