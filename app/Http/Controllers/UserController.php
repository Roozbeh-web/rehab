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
            'email'=> 'required|string',
            'password'=> 'required|string',
            ]
            ,[
                'email.required' => 'وارد کردن نام کاربری الزامی است.',
                'password.required' => 'وارد کردن رمز عبور الزامی است',
            ]);
            
            if($validator->fails()){
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $user = User::where("email", $request->email)->first();
                
                
            if(!$user || !Hash::check($request->password, $user->password) ){
                $error = 'مشخصات کاربری اشتباه است.';
                return Redirect::back()->with('error', $error)->withInput();
            }
            else{
                $remember_me  = ( empty( $request->remember ) )? FALSE : TRUE;
                Auth::login($user, $remember_me);
                if($user->profile){
                    return redirect('/dashboard');
                }
                return redirect('/new-user-profile');
            }
        }
    }

    public function getSignUp(){
        return view('signup', ['err'=>""]);
    }

    public function postSignUp(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'identity_code' => 'required|numeric|unique:users,identity_code',
            'type' => 'required',
            'password' => 'required|string|confirmed|min:8',
            'province' => 'required',
            'city' => 'required',
        ],
        [
            'firstname.required' => 'وارد کردن نام الزامی است.',
            'lastname.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'username.required' => 'وارد کردن نام کاربری الزامی است.',
            'username.unique' => 'کاربری با این نام وجود دارد.',
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.unique' => 'کاربری با این ایمیل وجود دارد.',
            'phone.required' => 'وارد کردن شماره همراه الزامی است.',
            'phone.numeric' => 'فقط از اعداد استفاده کنید.',
            'phone.unique' => 'کاربری با این شماره وجود دارد',
            'identity_code.required' => 'وارد کردن کد ملی الزامی است.',
            'identity_code.numeric' => 'فقط از اعداد استفاده کنید.',
            'identity_code.unique' => 'کاربری با این شماره ملی وجود دارد',
            'type.required' => 'نوع کاربری خود را انتخاب کنید.',
            'password.required' => 'وارد کردن رمز عبور الزامی است',
            'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کارکتر داشته باشد.',
            'province.required' => 'لطفا استان خود را انتخاب کنید.',
            'city.required' => 'لطفا شهر خود را انتخاب کنید.',
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
                'province' => $request->province,
                'city' => $request->city,
            ]);

            $token = $user->createToken('mytoken')->plainTextToken;

            Auth::login($user);
            // Auth::logout($user);

            return redirect('/new-user-profile', 201);
        }
    }

    public function logout(){
        $id = auth()->id();
        $user = User::where('id', $id)->first();
        Auth::logout($user);
        return redirect('/sign-in');
    }

    public function getLeaders(){
        if(auth()->user()->type === 'leader'){
            return Redirect::back();
        }
        return view('leaders');
    }
}
