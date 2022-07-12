<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Announcement;
use App\Models\Admin\AnnouncementImages;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAnnouncementController extends Controller
{
    public function createAnnouncement(Request $req){
        $validator = Validator::make($req->all(),[
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required','string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return redirect('/admin/announcement')
                        ->withErrors($validator, 'announcementCreate')
                        ->withInput();
        }
            
        $newAnnouncement = Announcement::create([
            'title' => $req['title'],
            'content' => $req['content']
        ]);
        
        if($req->has('images')){
            foreach($req->file('images') as $image){
                $imageName = str_replace(" ","",$req['title']).'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('AnnouncementImages'),$imageName);
                AnnouncementImages::create([
                    'announcement_id' => $newAnnouncement->id,
                    'image' => $imageName, 
                ]);
            }
        }
        return redirect('/admin/announcement')->with('success','Announcement Successfully Saved');
    }

    public function editAnnouncement($id){
        $data = Announcement::find($id);
        $images = AnnouncementImages::where("announcement_id","=",$id)->get();
        return response()->json([
            'data' => $data,
            'images' => $images
        ]);
    }

    public function updateAnnouncement(Request $req, $id){
        $validator = Validator::make($req->all(),[
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required','string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return redirect('/admin/announcement')
                        ->withErrors($validator, 'announcementUpdate')
                        ->withInput();
        }

        $announcementModel = Announcement::find($id);
        $announcementModel->title = $req['title'];
        $announcementModel->content = $req['content'];
        $announcementModel->update();

        if($req->has('images')){
            AnnouncementImages::where('announcement_id','=',$id)->delete();
            foreach($req->file('images') as $image){
                $imageName = str_replace(" ","",$req['title']).'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('AnnouncementImages'),$imageName);
                AnnouncementImages::create([
                    'announcement_id' => $id,
                    'image' => $imageName, 
                ]);
            }
        }

        return redirect('/admin/announcement')->with('success','Announcement Successfully Saved');
    }

    public function deleteAnnouncement($id){
        $announcementModel = Announcement::find($id);
        $announcementModel->delete();
        AnnouncementImages::where('announcement_id','=',$id)->delete();
        return redirect('/admin/announcement')->with('deleted','Announcement Successfully Deleted');
    }

    public function updateAdmin(Request $req){

        $validator = Validator::make($req->all(),[
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'username' => ['required', 'string', 'min:6','unique:student','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:student','unique:users','email:rfc,dns'],
            'password' => ['nullable','string', 'min:6', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect('/admin/account')
                        ->withErrors($validator, 'adminUpdate')
                        ->withInput();
        }

        if($req->password == ""){
            User::find(1)->update([
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->email
            ]);
        }
        else{
            User::find(1)->update([
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password)
            ]);
        }

        return redirect('/admin/account')->with('success','Admin Account Successfully Updated');
    }
}
