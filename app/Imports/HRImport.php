<?php

namespace App\Imports;

use App\Models\HR;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HRImport implements ToModel, WithHeadingRow
{
    public function __construct()
    {
        ini_set('max_execution_time', 300); // Increase execution time
    }

    public function model(array $row)
    {
        // Debugging: Uncomment this line to inspect column names if needed
        // dd(array_keys($row));

        $hr = HR::where('upn_no', $row['new_upn'] ?? '')->first();

        $data = [
            's_no'                          => $row['s/no.'] ??'',
            'payroll_num'                   => $row['payrollnum'] ?? '',
            'upn_no'                        => $row['new_upn'] ?? '',
            'name'                          => $row['name'] ?? '',
            'designation'                   => $row['designation'] ?? '',
            'job_group'                     => $row['job_group'] ?? '',
            'campus'                        => $row['campus'] ?? '',
            'job_designation'               => $row['job_designation'] ?? '',
            'job_code'                      => $row['job_code'] ?? '',
            'idnumber'                      => $row['idnumber'] ?? '',
            'ethnicity'                     => $row['ethnicity'] ?? '',
            'dob'                           => $this->convertDate($row['date_of_birth'] ?? ''),
            'disability'                    => $row['pwd'] ?? '',
            'gender'                        => $row['gender'] ?? '',
            'first_date_of_appointment'     => $this->convertDate($row['1st_date_of_appointment'] ?? ''),
            'current_date_of_appointment'   => $this->convertDate($row['current_date_of_appointment'] ?? ''),
            'home_county'                   => $row['home_county'] ?? '',
            'email'                         => $row['email_address'] ?? '',
            'phone'                         => $row['phoneno'] ?? '',
        ];

        if ($hr) {
            // Update existing record
            $hr->update($data);
            return $hr;
        } else {
            // Insert new record
            return new HR($data);
        }
    }

        
    private function convertDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // Check if the value is a numeric Excel date
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // Try converting string date format (e.g., "18/10/1959" → "1959-10-18")
        $date = \DateTime::createFromFormat('d/m/Y', $value);
        return $date ? $date->format('Y-m-d') : null;
    }

}