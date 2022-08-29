<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File as RulesFile;
use Throwable;

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
            'username' => 'required|string|unique:users,username',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric',
            'identity_code' => 'required|numeric',
            'type' => 'required',
            'password' => 'required|string|confirmed'

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

    public function getProfile(){
        return view('profile');
    }

    public function postProfile(Request $request){
        $validationDate = date('Y-m-d',strtotime('18 years ago'));

        $validator = Validator::make($request->all(),[
            'birthdate' => 'required|date|before:'.$validationDate,
            'province' => 'required',
            'city' => 'required',
            'avatar' => 'image'

        ],
        [
            'birthdate.required' => 'وارد کردن تاریخ تولد الزامی است.',
            'birthdate.before' => 'حداقل سن باید ۱۸ سال باشد.',
            'province.required' => 'لطفا استان خود را انتخاب کنید.',
            'city.required' => 'لطفا شهر خود را انتخاب کنید.',
            'avatar.image' => 'فرمت فایل انتخابی اشتباه است.',
            'avatar.size' => 'حجم عکس انتخابی باید کمتر از ۵ مگابایت باشد.'
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $profile = new Profile();

        if($request->file('avatar')){
            $image = $request->file('avatar');
            $imageName = auth()->user()->username.$image->getClientOriginalName();
            $image->move(public_path('public/Image'), $imageName);
            $profile['image'] = $imageName;
        }

        $profile['user_id'] = auth()->id();
        $profile['bio'] = $request->bio;
        $profile['birth_date'] = $request->birthdate;
        $profile['province'] = $request->province;
        $profile['city'] = $request->city;

        if(auth()->user()->type === 'helpseeker'){
            $profile->save();
            return redirect('/dashboard');
        }

        else if(auth()->user()->type === 'leader'){
            $validator->addRules([
                'documents' => 'required',
                'quit_date' => 'required|date',
            ]);

            $validator->setCustomMessages([
                'documents.required' => 'مدارک خود را بارگذاری کنید.',
                'quit_date.required' => 'ورود تاریخ ترک الزامی است.',
            ]);

            if($validator->fails()){
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $allowedfileExtension=['pdf','jpg','png','docx'];

            $documents = $request->file('documents');

            $maxSize = 12 * 1024;

            $username = auth()->user()->username;

            foreach($documents as $document){
                $size = $document->getSize() / 1000;
                $documentName = $username . '_' . $document->getClientOriginalName();
                $extension = $document->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);
                $isFit = $size < $maxSize ? true : false;

                if($check && $isFit){
                    $document->move(public_path('public/documents/'. $username . "/"), $documentName);

                    Document::create([
                        'user_id' => auth()->id(),
                        'document' => $documentName,
                    ]);
                }
                
                else{
                    $error = "";
                    
                    if(!$check){
                        $error = 'فرمت فایل اشتباه است.';
                    }else if(!$isFit){
                        $error = 'اندازه هر فایل باید کمتر از ۱۲ مگابایت باشد.';
                    }
                    
                    return Redirect::back()->with('error', $error)->withInput();
                }
            }

            $profile['quit_date'] = $request->quit_date;
            $profile->save();

            return redirect('/dashboard');
        }
    }
}
