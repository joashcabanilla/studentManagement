<?php

namespace App\Imports;

use App\Models\user\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class studentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'studentNumber' => $row['studentnumber'],
            'firstname' => $row['firstname'],
            'middlename' => $row['middlename'],
            'lastname' => $row['lastname'],
            'gender' => $row['gender'],
            'birthdate' => $row['birthdate'],
            'age' => $row['age'],
            'birthplace' => $row['birthplace'],
            'phone_number' => $row['phone_number'],
            'address' => $row['address'],
            'email' => $row['email'],
            'username' => $row['studentnumber'],
            'password' => Hash::make($row['lastname'])
        ]);
    }
}
