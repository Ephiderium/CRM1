<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    #[OA\Get(
        path: "/api/export-tables",
        summary: "Экспорт всех таблиц в XLSX",
        tags: ["excel"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Файл Excel (.xlsx) с экспортированными таблицами",
                content: new OA\MediaType(
                    mediaType: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    schema: new OA\Schema(
                        type: "string",
                        format: "binary"
                    ),
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function exportTables()
    {
        //
    }

    #[OA\Get(
        path: "/api/export-log",
        summary: "Экспорт логов",
        tags: ["excel"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Файл Excel (.xlsx) с экспортированными логами действий",
                content: new OA\MediaType(
                    mediaType: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    schema: new OA\Schema(
                        type: "string",
                        format: "binary"
                    ),
                )
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function exportLog()
    {
        //
    }

    #[OA\Post(
        path: "/api/import-clients",
        summary: "Импорт клиентов из CSV",
        tags: ["excel"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    required: ["file"],
                    properties: [
                        new OA\Property(
                            property: "file",
                            description: "CSV-файл с клиентами",
                            type: "string",
                            format: "binary"
                        ),
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Success",
            ),
            new OA\Response(
                response: 500,
                description: "Error server",
            )
        ]
    )]
    public function importClients(Request $request)
    {
        //
    }
}
