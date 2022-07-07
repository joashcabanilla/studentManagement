<?php

namespace App\Imports;

use App\Models\User;
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
        return new User([
            'name' => strtoupper($row['lastname'] . ", " . $row['firstname'] . " " . substr($row['middlename'],0,1)),
            'username' => $row['studentnumber'],
            'email' => $row['email'],
            'password' => Hash::make($row['lastname'])
        ]);
    }
}
