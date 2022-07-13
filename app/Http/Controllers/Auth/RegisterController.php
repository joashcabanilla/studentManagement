<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User\Student;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'unique:users,name']
            'firstname' => ['required', 'string', 'max:255','min:2'],
            'middlename' => ['nullable','string', 'min:2'],
            'lastname' => ['required', 'string', 'max:255','min:2'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'age' => ['required'],
            'birthplace' => ['required', 'string', 'max:255'],
            'phone_number' => ['required','min:10'],
            'address' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','email:rfc,dns'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //concatenate first,middle,last name
        $name = $data['lastname'] . ", " . $data['firstname'] . " " . substr($data['middlename'],0,1);
        
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

             // create account for student table
             Student::create([
                'studentNumber' => $studentNo,
                'firstname' => $data['firstname'],
                'middlename' => $data['middlename'],
                'lastname' => $data['lastname'],
                'gender' => $data['gender'],
                'birthdate' => $data['birthdate'],
                'age' => $data['age'],
                'birthplace' => $data['birthplace'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);

            //create account for users table
            return User::create([
                'name' => strtoupper($name),
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
    }

    public function showRegistrationForm(){
        $studentNumber = Student::max('studentNumber');
         if($studentNumber != NULL){
            $studentNumberYear = explode("-",$studentNumber)[0];
            $studentNo = intval(explode("-",$studentNumber)[1]);
            $studentNo = $studentNumberYear == date('Y') ? $studentNumberYear."-".sprintf("%04d", ++$studentNo) : date('Y')."-".sprintf("%04d", 1);
         }
         else{
            $studentNo = date('Y')."-".sprintf("%04d", 1);
         }
        return view('auth.register',['studentNumber'=>$studentNo, 'nameError' => '']);
    }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     event(new Registered($user = $this->create($request->all())));
    //     return redirect($this->redirectPath())->with('message', 'account successfully registered');
    // }
}
