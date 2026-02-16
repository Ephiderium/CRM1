<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('status'))) {
            return $next($builder);
        }

        $key = $this->request->validated('status');
        $query = $builder->where('status', $key);

        return $next($query);
    }
}
