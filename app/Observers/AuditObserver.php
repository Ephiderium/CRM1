<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuditObserver
{
    public function create(Model $model): void
    {
        $this->log('created', $model);
    }

    public function update(Model $model): void
    {
        $this->log('update', $model);
    }

    public function delete(Model $model): void
    {
        $this->log('delete', $model);
    }

    protected function log(string $event, Model $model)
    {
        $changes = match ($event) {
            'created' => [
                'old' => null,
                'new' => $model->getAttributes(),
            ],
            'update' => [
                'old' => $model->getOriginal(),
                'new' => $model->getChanges(),
            ],
            'delete' => [
                'old' => $model->getOriginal(),
                'new' => null,
            ],
        };

        DB::table('audit_logs')->insert([
            'user_id' => Auth::user()->id,
            'action' => $event,
            'entity_type' => get_class($model),
            'entity_id' => $model->getKey(),
            'old_values' => $changes['old'] ? json_encode($changes['old']) : null,
            'new_values' => $changes['new'] ? json_encode($changes['new']) : null,
        ]);
    }
}
