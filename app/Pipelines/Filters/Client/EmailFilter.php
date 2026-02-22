<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class EmailFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->email)) {
            return $next($builder);
        }

        $key = $this->dto->email;
        $query = $builder->where('email', $key);

        return $next($query);
    }
}
