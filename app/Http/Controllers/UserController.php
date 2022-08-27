<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getSignIn(){
        return view('signin');
    }
    public function postSignIn(Request $request){
        $user = "";
        $validator = Validator::make($request->all(),
        [
            'username'=> 'required|string',
            'password'=> 'required|string',
            ]
            ,[
                'username.required' => 'وارد کردن نام کاربری الزامی است.',
                'password.required' => 'وارد کردن رمز عبور الزامی است',
            ]);
            
            if($validator->fails()){
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $user = User::where("username", $request->username)->first();
                
                
            if(!$user || !Hash::check($request->password, $user->password) ){
                $error = 'مشخصات کاربری اشتباه است.';
               return Redirect::back()->with('error', $error)->withInput();
            }
            else{
                Auth::login($user);
                return redirect('/profile');
            }
        }
    }

    public function getSignUp(){
        return view('signup', ['err'=>""]);
    }

    public function postSignUp(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required',
            'phone' => 'required|numeric',
            'identity_code' => 'required|numeric',
            'type' => 'required',
            'password' => 'required|string|confirmed'

        ],
        [
            'firstname.required' => 'وارد کردن نام الزامی است.',
            'lastname.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'username.required' => 'وارد کردن نام کاربری الزامی است.',
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'phone.required' => 'وارد کردن شماره همراه الزامی است.',
            'phone.numeric' => 'فقط از اعداد استفاده کنید.',
            'identity_code.required' => 'وارد کردن کد ملی الزامی است.',
            'identity_code.numeric' => 'فقط از اعداد استفاده کنید.',
            'type.required' => 'نوع کاربری خود را انتخاب کنید.',
            'password.required' => 'وارد کردن رمز عبور الزامی است',
            'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارد.'
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else{
            $user = User::create([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'identity_code' => $request->identity_code,
                'password' => bcrypt($request->password),
            ]);

            $token = $user->createToken('mytoken')->plainTextToken;

            Auth::login($user);
            // Auth::logout($user);

            return redirect('/profile', 201);
        }
    }
}
