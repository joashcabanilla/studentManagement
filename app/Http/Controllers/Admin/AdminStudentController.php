<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User\Student;
use App\Models\User;
use Illuminate\Validation\Rule;
use DB;


class AdminStudentController extends Controller
{
    public function createStudent(Request $req){
        $rules = [
            'name' => ['required', 'string', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255','min:2'],
            'middlename' => ['nullable','string', 'min:2'],
            'lastname' => ['required', 'string', 'max:255','min:2'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'age' => ['required'],
            'birthplace' => ['required', 'string', 'max:255'],
            'phone_number' => ['required','min:10', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6','unique:student','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:student','unique:users','email:rfc,dns'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $messages = [
            'name.unique' => 'the name that you entered is already registered',
        ];

        $validator = Validator::make($req->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/admin/student')
                        ->withErrors($validator, 'studentCreate')
                        ->withInput();
        }
        
        //concatenate first,middle,last name
        $name = $data['lastname'] . ", " . $data['firstname'] . " " . $data['middlename'];

        //create account for student table
        Student::create([
            'studentNumber' => $req['studentnumber'],
            'firstname' => $req['firstname'],
            'middlename' => $req['middlename'],
            'lastname' => $req['lastname'],
            'gender' => $req['gender'],
            'birthdate' => $req['birthdate'],
            'age' => $req['age'],
            'birthplace' => $req['birthplace'],
            'phone_number' => $req['phone_number'],
            'address' => $req['address'],
            'email' => $req['email'],
            'username' => $req['username'],
            'password' => Hash::make($req['password']),
        ]);

         //create account for users table
        User::create([
            'name' => strtoupper($name),
            'username' => $req['username'],
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
        ]);
        
        return redirect('/admin/student')->with('success','Student Account Successfully Created');
    }

    public function editStudent($username){
        $student = Student::where('username','=',$username)->get();
        return response()->json([
            'student' => $student,
        ]);
    }

    public function updateStudent(Request $req, $username, $email){
        $rules = [
            'name' => ['required', 'string', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255','min:2'],
            'middlename' => ['nullable','string', 'min:2'],
            'lastname' => ['required', 'string', 'max:255','min:2'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'age' => ['required'],
            'birthplace' => ['required', 'string', 'max:255'],
            'phone_number' => ['required','min:10', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6',Rule::unique('student')->ignore($username, 'username')],
            'email' => ['required', 'string', 'email', 'max:255','email:rfc,dns', Rule::unique('student')->ignore($email, 'email')],
            'password' => ['nullable','string', 'min:6', 'confirmed'],
        ];

        $messages = [
            'name.unique' => 'the name that you entered is already registered',
        ];
        
        $validator = Validator::make($req->all(),$rules, $messages);

        //concatenate first,middle,last name
        $name = $data['lastname'] . ", " . $data['firstname'] . " " . $data['middlename'];

        if ($validator->fails()) {
            return response()->json(['status'=>400,'errors'=>$validator->messages()]); 
        }

        if($req->input('password') == ""){
            Student::where('username','=',$username)->update([
                'firstname' => $req->input('firstname'),
                'middlename' => $req->input('middlename'),
                'lastname' => $req->input('lastname'),
                'gender' => $req->input('gender'),
                'birthdate' => $req->input('birthdate'),
                'birthplace' => $req->input('birthplace'),
                'phone_number' => $req->input('phone_number'),
                'address' => $req->input('address'),
                'username' => $req->input('username'),
                'email' => $req->input('email'),
            ]);
            User::where('username','=',$username)->update([
                'name' => strtoupper($name),
                'username' => $req['username'],
                'email' => $req['email'],
            ]);
            return response()->json(['status'=>200]);
        }
        else{
            Student::where('username','=',$username)->update([
                'firstname' => $req->input('firstname'),
                'middlename' => $req->input('middlename'),
                'lastname' => $req->input('lastname'),
                'gender' => $req->input('gender'),
                'birthdate' => $req->input('birthdate'),
                'birthplace' => $req->input('birthplace'),
                'phone_number' => $req->input('phone_number'),
                'address' => $req->input('address'),
                'username' => $req->input('username'),
                'email' => $req->input('email'),
                'password' => Hash::make($req->input('password')),
            ]);
            User::where('username','=',$username)->update([
                'name' => strtoupper($name),
                'username' => $req['username'],
                'email' => $req['email'],
                'password' => Hash::make($req->input('password')),
            ]);
            return response()->json(['status'=>200]);
        }
    }

    public function deleteStudent($username){
        Student::where('username','=',$username)->delete();
        User::where('username','=',$username)->delete();
        return redirect('/admin/student');
    }
}
