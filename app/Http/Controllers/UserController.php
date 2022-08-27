<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getSignIn(){
        return view('signin');
    }

    public function postSignIn(Request $request){
        dd($request);
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
            // dd($validator->messages()->get('firstname'));
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }
}
