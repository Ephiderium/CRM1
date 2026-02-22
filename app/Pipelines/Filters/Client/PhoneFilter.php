<?php

namespace App\Pipelines\Filters\Client;

use App\Pipelines\Filters\FilterInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class PhoneFilter implements FilterInterface
{
    public function __construct(protected $dto) {}

    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->dto->phone)) {
            return $next($builder);
        }

        $key = $this->dto->phone;
        $query = $builder->where('phone', $key);

        return $next($query);
    }
}
