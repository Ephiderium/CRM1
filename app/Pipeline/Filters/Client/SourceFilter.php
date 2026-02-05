<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SourceFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('source'))) {
            return $next($builder);
        }

        $key = $this->request->validated('source');
        $query = $builder->where('source', $key);

        return $next($query);
    }
}
