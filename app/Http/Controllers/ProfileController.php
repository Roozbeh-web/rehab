<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\Document;
use App\Models\UserDrug;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    public function getNewUserProfile(){
        if(auth()->user()->profile){
            return redirect('/dashboard');
        }
        $drugs = json_decode(Redis::get('drugs'));
        return view('profile', ['drugs' => $drugs]);
    }

    public function postNewUserProfile(Request $request){
        $validationDate = date('Y-m-d',strtotime('18 years ago'));

        $validator = Validator::make($request->all(),[
            'birthdate' => 'required|date|before:'.$validationDate,
            'avatar' => 'image',
            'drugs' => 'required',

        ],
        [
            'birthdate.required' => 'وارد کردن تاریخ تولد الزامی است.',
            'birthdate.before' => 'حداقل سن باید ۱۸ سال باشد.',
            'avatar.image' => 'فرمت فایل انتخابی اشتباه است.',
            'avatar.size' => 'حجم عکس انتخابی باید کمتر از ۵ مگابایت باشد.',
            'drugs.required' => 'حداقل یک ماده انتخاب کنید.',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $profile = new Profile();

        if($request->file('avatar')){
            $image = $request->file('avatar');

            $path = $image->storeAs('public/avatar/'.auth()->user()->username, auth()->user()->username.".".$image->extension());
            
            $pathArray = explode('/', $path);
            $path = $pathArray[1] . '/' . $pathArray[2] . '/' . $pathArray[3];

            $profile['image'] = $path;
        }

        $profile['user_id'] = auth()->id();
        $profile['bio'] = $request->bio;
        $profile['birth_date'] = $request->birthdate;

        foreach($request->drugs as $drug){
            UserDrug::create([
                'user_id' => auth()->id(),
                'name' => $drug,
            ]);
        }

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
                    $path = $document->storeAs('public/document/'.$username, $documentName);
            
                    $pathArray = explode('/', $path);
                    $path = $pathArray[1] . '/' . $pathArray[2] . '/' . $pathArray[3];

                    Document::create([
                        'user_id' => auth()->id(),
                        'document' => $path,
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

    public function getEditProfile(){
        return view('editProfile');
    }

}
