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
        try {
            return Excel::download(new ExportTables(), 'tables.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => 'error export: ' . $e->getMessage()], 500);
        }
    }

    public function exportLog(): BinaryFileResponse|JsonResponse
    {
        try {
            return Excel::download(new ExportLog(), 'log.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => 'error export: ' . $e->getMessage()], 500);
        }
    }

    public function importClients(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,xls',
            ]);
            Excel::import(new ClientsImport, $request->file('file'));

            return back()->with('success', 'Данные импортированы');
        } catch (\Exception $e) {
            return response()->json(['error' => 'error import: ' . $e->getMessage()], 500);
        }
    }
}
