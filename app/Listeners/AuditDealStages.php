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
        DB::table('audit_logs')->insert([
            'user_id' => Auth::user()->id,
            'action' => 'change deal stage',
            'entity_type' => Deal::class,
            'entity_id' => $event->deal_id,
            'old_values' => $event->oldValue,
            'new_values' => $event->newValue,
        ]);
    }
}
