<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Student;
use App\Models\User;
use App\Models\Admin\Announcement;
use App\Models\Admin\AnnouncementImages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserHomeController extends Controller
{
    public function index(){
        $announcement = Announcement::latest()->get();
        $announcementImages = AnnouncementImages::all();
        $imageId = AnnouncementImages::distinct()->get('announcement_id');
        return view('user.index',
        [
            'title' => 'Announcement',
            'announcement'=>$announcement, 
            'announcementImages' => $announcementImages, 
            'imageId' => $imageId
        ]);
    }

    public function profile($id){
        $username = User::where("id", "=",$id)->get("username");
        $collection = Student::where('username', '=', $username[0]->username)->get();
        if($collection[0]->profile != ""){
            $profile = $collection[0]->profile;
        }
        else{
            $profile = "profilepic.png";
        }
        return view('user.profile',['title' => 'Student Profile','username' => $username, 'data' => $collection, 'profile'=> $profile]);   
    }

    public function updateStudent(Request $req, $username){
        $validator = Validator::make($req->all(),[
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
            'password' => ['nullable','string', 'min:6', 'confirmed'],
        ]);

        //concatenate first,middle,last name
        $name = $req['lastname'] . ", " . $req['firstname'] . " " . substr($req['middlename'],0,1);
        $id = User::where("username", "=",$username)->get("id");

        if ($validator->fails()) {
            return redirect('/user/profile/'. $id[0]->id)
            ->withErrors($validator, 'updateStudentProfile')
            ->withInput();
        }
        else{
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
            }

            if($req->has('images')){
                foreach($req->file('images') as $image){
                    $imageName = str_replace(" ","",$req['username']).'-image-'.time().rand(1,1000).'.'.$image->extension();
                    $image->move(public_path('studentProfile'),$imageName);
                    Student::where('username','=',$req['username'])->update([
                        'profile' => $imageName,
                    ]);
                }
            }
            return redirect('/user/profile/'. $id[0]->id)->with('success','Student Profile Successfully Saved');
        }
    }
}
