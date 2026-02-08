<?php

namespace App\Listeners;

use App\Events\TaskStatus;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditTaskStatus
{
    /**
     * Create the event listener.
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     */
    public function handle(TaskStatus $event): void
    {
        DB::table('audit_logs')->insert([
            'user_id' => Auth::user()->id,
            'action' => 'change task status',
            'entity_type' => Task::class,
            'entity_id' => $event->task_id,
            'old_values' => $event->oldValue ? json_encode($event->oldValue) : null,
            'new_values' => $event->newValue ? json_encode($event->oldValue) : null,
        ]);
    }
}
