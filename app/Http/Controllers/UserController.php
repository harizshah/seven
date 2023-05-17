<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Storage;

class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        if($request->hasFile('image')){
            User::uploadAvatar($request->image);
            return redirect()->back()->with('message','Image Uploaded.'); // success message
        }
        return redirect()->back()->with('error','Image not Uploaded.'); // error message
    }



    public function index() {
        $data = [
          'name' => 'Elon',
            'email' => 'elonsssss@gmail,com',
            'password' => 'password',
            'mobile' => 443334,
        ];
//        User::create($data);
//        Eloquent
//        $user = new User();
//        $user->name = 'hariz';
//        $user->email = 'harizsharizad@gmail.com';
//        $user->password = bcrypt('password');
//        $user->save();

        $user = User::all();
        return $user;

//        User::where('id',2)->delete();

//        User::where('id',3)->update(['name'=>'harizdindin']);
//
//        $user = User::all();
//        return $user;

//        Database
//        DB::insert('insert into users (name,email,password) values(?,?,?) ',
//            ['hariz','harizshariza@gg.com','password']);
//        DB::update('update users set name = ? where id = 2',['din']);
//        $deleted = DB::delete('delete from users');
//        $users = DB::select('select * from users');
//        return $users;
        return view('home');
    }
}
