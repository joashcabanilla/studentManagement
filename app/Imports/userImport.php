<?php

namespace App\Imports;

use App\Models\User;
use App\Models\user\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class userImport implements ToModel, WithHeadingRow
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

        return new User([
            'name' => strtoupper($row['lastname'] . ", " . $row['firstname'] . " " . substr($row['middlename'],0,1)),
            'username' => $studentNo,
            'email' => $row['email'],
            'password' => Hash::make($row['lastname'])
        ]);
    }
}
