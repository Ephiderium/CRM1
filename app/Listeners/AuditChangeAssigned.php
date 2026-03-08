<?php

namespace App\Listeners;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditChangeAssigned
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user_name = Auth::user()->name;
        $user_id = Auth::user()->id;
        $old = $event->oldValue ? json_encode($event->oldValue) : null;
        $new = $event->newValue ? json_encode($event->oldValue) : null;
        activity()->log("Change assigned in Task(id: $event->task_id) \n
                        old assign: $old, new assign: $new \n
                        who changed: $user_name(id: $user_id)");
    }
}
