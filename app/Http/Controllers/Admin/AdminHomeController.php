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
        $collection = Student::all();
        return view('admin.student',['title'=>"Student Account",'collection'=>$collection]);
    }
    
    public function announcement(){ 
        return view('admin.announcement',['title'=>'Announcement']);
    }

    public function adminAccount(){
        return view('admin.adminAccount',['title'=>"Admin Account"]);
    }
}
