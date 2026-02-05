<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class EmailFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('email'))) {
            return $next($builder);
        }

        $key = $this->request->validated('email');
        $query = $builder->where('email', $key);

        return $next($query);
    }
}
