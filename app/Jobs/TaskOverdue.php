<?php

namespace App\Jobs;

use App\Repository\Eloquent\Interfaces\TaskRepositoryInterface;

class TaskOverdue
{
    public function __construct(
        protected TaskRepositoryInterface $tasks,
    ) {}

     public function handle(): void
    {
        $this->tasks->deadline();
    }
}
