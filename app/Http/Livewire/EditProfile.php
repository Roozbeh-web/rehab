<?php

namespace App\Http\Livewire;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $firstName;
    public $lastName;
    public $phone;
    public $avatar;
    public $password;
    public $password_confirmation;
    public $msg;
    public $color = 'green';

    protected $rules = [
        'firstName' => 'nullable|string|max:60',
        'lastName' => 'nullable|string|max:60',
        'phone' => 'nullable|numeric|unique:users,phone',
        'password' => 'nullable|string|min:8',
        'avatar' => 'image|nullable',
    ];

    protected $messages = [
        'firstName.max' => 'نام نمی‌تواند از ۶۰ کاراکتر بیشتر باشد.',
        'firstName.max' => 'نام خانوادگی نمی‌تواند از ۶۰ کاراکتر بیشتر باشد.',
        'phone.numeric' => 'فقط از اعداد استفاده کنید.',
        'phone.unique' => 'کاربری با این شماره تلفن وجود دارد.',
        'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
        'password.confirmed' => 'رمز عبور با تکرار آن مطابقت ندارد.',
        'avatar.image' => 'فرمت فایل اشتباه است.',
    ];

    public function makeChange(){
        $this->validate();
        $user = User::where('id', auth()->id())->first();
        if($this->firstName){
            $user->update(['first_name'=>$this->firstName]);
            $this->firstName = null;
        }
        if($this->lastName){
            $user->update(['last_name'=>$this->lastName]);
            $this->lastName = null;
        }
        if($this->phone){
            $user->update(['phone'=>$this->phone]);
            $this->phone = null;
        }
        if($this->avatar){
            $image = $this->avatar;
            $path = $image->storeAs('public/avatar/'.$user->username, $user->username.".".$this->avatar->extension());
            
            $pathArray = explode('/', $path);
            $path = $pathArray[1] . '/' . $pathArray[2] . '/' . $pathArray[3];
            // dd($path);
            $user->profile->update(['image'=>$path]);
            $this->avatar = null;
        }
        if($this->password && ($this->password === $this->password_confirmation)){
            $user->update(['password'=>bcrypt($this->password)]);
            $this->password = null;
            $this->password_confirmation = null;
        }else if($this->password !== $this->password_confirmation){
            $this->msg = 'رمز عبور با تکرار آن مطابقت ندارد.';
            $this->color = 'red';
        }
        if(!$this->msg){
            $this->msg = 'تغییرات با موفقیت ثبت شد.';
            return Redirect::route('edit-profile')->with('msg',$this->msg);
        }
    }
    
    public function render()
    {
        $user = User::where('id', auth()->id())->first();
        $user = new UserResource($user);
        $this->user = $user->toArray('');
        // dd($this->user);
        return view('livewire.edit-profile');
    }
}
