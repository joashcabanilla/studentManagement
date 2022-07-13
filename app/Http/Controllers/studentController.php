<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\Student;
use App\Models\User;
use DB;

class studentController extends Controller
{
//  public function index(){
//   $month = date('m');
//   $year = date('Y');
//   $date = Student::select( DB::raw('DATE(created_at) AS date'),DB::raw('COUNT(*) AS count'))
//   ->whereMonth('created_at', '=', $month)->groupBy( DB::raw('DATE(created_at)'))
//   ->whereYear('created_at', '=', $year)
//   ->get();

//   return view('student',['dateWeek'=>$date]);
//  }   

public function index(){
    // $studentModel = Student::where("username", "=", "joash1")->get();
    // $userModel = User::where("username", "=", "joash1")->get();
    // $studentModel->delete();
    // $userModel->delete();
    // return view("student", ["usernameModel"=>$studentModel, "usernameUser"=>$userModel]);

    $nameExist = Student::where('firstname', '=', 'ashfirst')->where('middlename', '=', 'ash')->where('lastname', '=', 'ash')->count();
    
    dd($nameExist);
    return view("student");
}
}
