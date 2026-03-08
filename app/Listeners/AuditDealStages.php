<?php

namespace App\Listeners;

use App\Events\DealStage;
use App\Models\Deal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditDealStages
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
    public function handle(DealStage $event): void
    {
        $id = $event->deal_id;
        $user_name = Auth::user()->name;
        $user_id = Auth::user()->id;
        $old = $event->oldValue ? json_encode($event->oldValue) : null;
        $new = $event->newValue ? json_encode($event->oldValue) : null;
        activity()->log("Change deal(id: $id) stage \n
                    who changed: $user_name (id: $user_id) \n
                    old stage: $old, new stage: $new");
    }
}
