<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class NameFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('name'))) {
            return $next($builder);
        }

        $key = $this->request->validated('name');
        $query = $builder->where('name', $key);

        return $next($query);
    }
}
