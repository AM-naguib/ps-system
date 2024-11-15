<?php

namespace App\Http\Controllers\Panel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function index(){
        return view('panel.auth.login');
    }

    public function store(Request $request){
        $data =Validator::make($request->all(),[
            "phone" => "required",
            "password" => "required",
            "user_type"=>"required"
        ]);

        if($data->fails()){
            return redirect()->back()->withErrors($data->errors());
        }
        $userData = $data->validate();

        if(auth()->guard($userData['user_type'])->attempt([
            "phone" => $userData['phone'],
            "password" => $userData['password']
        ])){

            return to_route("panel.index");
        }
        return redirect()->back()->with("error","خطأ في اسم المستخدم او كلمة المرور");


    }


    public function logout(){
        auth()->logout();
        return to_route("panel.login");
    }
}
