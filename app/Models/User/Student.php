<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $table = "student";
    protected $fillable = [
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
        'email',
        'username',
        'password',
        'profile'
    ];
}
