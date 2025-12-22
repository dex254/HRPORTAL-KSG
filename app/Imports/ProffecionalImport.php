<?php

namespace App\Imports;

use App\Models\Proffecional;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProffecionalImport implements ToModel, WithHeadingRow
{
    public function __construct()
    {
        ini_set('max_execution_time', 300); // Increase execution time
    }

    public function model(array $row)
    {
       
        $proffecional = Proffecional::where('no', $row['no'] ?? '')->first();

        $data = [
            'no'   => $row['no'] ?? '',
            'name' => $row['name'] ?? '',
            'law'  => $row['law'] ?? '',
        ];

        if ($proffecional) {
            // Update existing record
            $proffecional->update($data);
            return $proffecional;
        } else {
            // Insert new record
            return new Proffecional(array_merge(['no' => $row['no']], $data));
        }
    }
}