<?php

namespace App\Pipeline\Filters\Client;

use App\Pipeline\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class PhoneFilter implements FilterInterface
{
    public function __construct(protected $request) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->request->validated('phone'))) {
            return $next($builder);
        }

        $key = $this->request->validated('phone');
        $query = $builder->where('phone', $key);

        return $next($query);
    }
}
