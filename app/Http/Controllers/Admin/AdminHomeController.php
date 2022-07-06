<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Student;

class AdminHomeController extends Controller
{
    public function index(){
        return view('admin.index',['title'=>'Dashboard']);
    }

    public function studentAccount(){
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

        $collection = Student::all();
        return view('admin.student',['title'=>"Student Account",'collection'=>$collection, "studentNumber"=>$studentNo]);
    }
    
    public function announcement(){ 
        return view('admin.announcement',['title'=>'Announcement']);
    }

    public function adminAccount(){
        return view('admin.adminAccount',['title'=>"Admin Account"]);
    }
}
