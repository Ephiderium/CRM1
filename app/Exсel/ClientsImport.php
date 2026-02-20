<?php

namespace App\Exсel;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'company' => $row['company'],
            'source' => $row['source'],
            'manager_id' => $row['manager_id'] ?? 1,
            'status' => $row['status'],
        ]);
    }
}
