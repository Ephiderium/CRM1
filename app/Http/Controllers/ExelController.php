<?php

namespace App\Http\Controllers;

use App\Exсel\ExportTables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExelController extends Controller
{
    public function exportTables(): BinaryFileResponse
    {
        return Excel::download(new ExportTables(), 'tables.xlsx');
    }

    public function exportLog(): BinaryFileResponse
    {
        return Excel::download();
    }
}

