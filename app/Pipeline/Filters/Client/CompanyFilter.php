<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class CompanyFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('company'))) {
            return $next($builder);
        }

        $key = $this->request->validated('company');
        $query = $builder->where('company', $key);

        return $next($query);
    }
}
