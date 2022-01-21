<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function image_update(Request $request){
        $request->validate([
            'image' => 'required|',
        ]);

        $admin = Admin::find(Auth::guard('admin')->id());

        $image = $request->file('image');

        $ext = Str::lower($image->getClientOriginalExtension());
        $full_name = $admin->name.".".$ext;
        $folder = "asset/img/avatars/admin";
        $url = $folder."/".$full_name;
        $image->move($folder,$full_name);

        unlink($admin->avatar);

        $admin->avatar = $url;
        $admin->save();

        $notification = array(
            'messege' => 'Profile Image Changed Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function brake(){
        Artisan::call('down',['--secret'=>"1630542a-246b-4b66-afa1-dd72a4c43515",'--render'=>'admin.brake']);
       dd('site down successfully');
    }

    public function up(){
        Artisan::call('up');
        dd('site up successfully');
    }
}
