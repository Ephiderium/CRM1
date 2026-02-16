<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;

class ClientPipeline
{
    protected array $filters = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function apply(Builder $builder): Builder
    {
        return app(\Illuminate\Pipeline\Pipeline::class)
            ->send($builder)
            ->through($this->filters)
            ->thenReturn();
    }
}
