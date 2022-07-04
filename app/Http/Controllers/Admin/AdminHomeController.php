<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        return view('admin.index',['title'=>'Dashboard']);
    }

    public function studentAccount(){
        return view('admin.student',['title'=>"Student's Account"]);
    }
    
    public function announcement(){
        return view('admin.announcement',['title'=>'Announcement']);
    }

    public function adminAccount(){
        return view('admin.adminAccount',['title'=>"Admin Account"]);
    }
}
