<?php

namespace App\Exсel;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLog implements FromCollection
{
    public function collection()
    {
        $log = DB::table('audit_logs')
            ->select('*')
            ->limit(1000)
            ->get();

        return $log;
    }
}
