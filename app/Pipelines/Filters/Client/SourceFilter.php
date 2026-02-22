<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SourceFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->source)) {
            return $next($builder);
        }

        $key = $this->dto->source;
        $query = $builder->where('source', $key);

        return $next($query);
    }
}
