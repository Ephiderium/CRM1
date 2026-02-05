<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Pipeline;

class ClientPipeline
{
    protected array $filters = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function apply(Builder $builder): Builder
    {
        return app(Pipeline::class)
            ->send($builder)
            ->through($this->filters)
            ->thenReturn();
    }
}
