<?php

namespace App\Exсel;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLog implements FromCollection
{
    public function collection()
    {
        $log = DB::table('audit_logs')
            ->select([
                'id',
                'user_id',
                'action',
                'entity_type',
                'entity_id',
                'old_values',
                'new_values',
                'created_at',

            ])
            ->orderBy('created_at', 'desc')
            ->limit(1000)
            ->get();

        return $log;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Событие',
            'Объект',
            'ID объекта',
            'Пользователь',
            'Дата и время'
        ];
    }

    public function map($row): array
    {
        $modelName = match($row->entity_type) {
            'App\Models\User' => 'Пользователь',
            'App\Models\Client' => 'Клиент',
            'App\Models\Deal' => 'Сделка',
            'App\Models\Task' => 'Задача',
            default => class_basename($row->entity_type)
        };

        return [
            $row->id,
            $row->user_id,
            $row->action,
            $row->$modelName,
            $row->entity_id,
            date('d.m.Y H:i', strtotime($row->created_at))
        ];
    }
}
