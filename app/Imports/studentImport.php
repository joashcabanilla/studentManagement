<?php

namespace App\Imports;

use App\Models\user\Student;
use App\Models\User;
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
        //generate new student number
        $studentNumber = Student::max('studentNumber');
         if($studentNumber != NULL){
            $studentNumberYear = explode("-",$studentNumber)[0];
            $studentNo = intval(explode("-",$studentNumber)[1]);
            $studentNo = $studentNumberYear == date('Y') ? $studentNumberYear."-".sprintf("%04d", ++$studentNo) : date('Y')."-".sprintf("%04d", 1);
         }
         else{
            $studentNo = date('Y')."-".sprintf("%04d", 1);
         }

        //create account for users table
        User::create([
            'name' => strtoupper($row['lastname'] . ", " . $row['firstname'] . " " . substr($row['middlename'],0,1)),
            'username' => $studentNo,
            'email' => $row['email'],
            'password' => Hash::make($row['lastname']),
        ]);

        return new Student([
            'studentNumber' => $studentNo,
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
            'username' => $studentNo,
            'password' => Hash::make($row['lastname'])
        ]);
    }
}
