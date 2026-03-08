<?php

namespace App\Http\Controllers;

use App\Exсel\ClientsImport;
use App\Exсel\ExportLog;
use App\Exсel\ExportTables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ExcelController extends Controller
{
    public function exportTables(): BinaryFileResponse|JsonResponse
    {
        return Excel::download(new ExportTables(), 'tables.xlsx');
    }

    public function exportLog(): BinaryFileResponse|JsonResponse
    {
        return Excel::download(new ExportLog(), 'log.xlsx');
    }

    public function importClients(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);
        Excel::import(new ClientsImport, $request->file('file'));

        return back()->with('success', 'Данные импортированы');
    }
}
