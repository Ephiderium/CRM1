<?php

namespace App\Exсel;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTables implements FromCollection
{
    public function collection()
    {
        $users = DB::table('users')
            ->leftJoin('deals', 'users.id', '=', 'deals.manager_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.manager_id')
            ->leftJoin('tasks', 'users.id', '=', 'tasks.assigned_to')
            ->select(
                'users.name',
                'users.email',
                'deals.id as deal_id',
                'deals.client_id',
                'deals.manager_id',
                'deals.amount',
                'deals.stage',
                'clients.id',
                'clients.name',
                'clients.phone',
                'clients.email',
                'clients.company',
                'clients.source',
                'clients.manager_id as client_manager',
                'clients.status',
                'tasks.id as task_id',
                'tasks.title',
                'tasks.description',
                'tasks.assigned_to',
                'tasks.due_date',
                'tasks.status',
            )
            ->limit(1000)
            ->get();

        // $users = User::with(['deals', 'clients', 'tasks'])->get();
        return $users;
    }
}
