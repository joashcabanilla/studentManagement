<?php

namespace App\Exports;

use App\Models\User\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class studentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::select(
            'studentNumber',
            'firstname',
            'middlename',
            'lastname',
            'gender',
            'birthdate',
            'age',
            'birthplace',
            'phone_number',
            'address',
            'email'
            )->get();
    }

    public function headings(): array
    {
        return [
            'Student Number',
            'First Name',
            'Middle Name',
            'Last Name',
            'Gender',
            'Birthdate',
            'Age',
            'Birth Place',
            'Phone Number',
            'Address',
            'Email Address',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'G' => 10,           
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],

        ];
    }
    
}
