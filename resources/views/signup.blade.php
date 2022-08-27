@extends('base')
@extends('templates.navbar')

@section('content')
<h1 class="signup-header-txt">ثبت‌نام</h1>
<div class="form-container signup">
    <form action="/sign-up" class="signup-form" method="POST">
        <div class="signup-form-inner-container">
            @csrf
            <label>نام</label><br>
            <input type="text" name="firstname"><br>
            <label>نام کاربری</label><br>
            <input type="text" name="username"><br>
            <label>شماره همراه</label><br>
            <input type="text" name="phone" class="left-to-right-input"><br>
            <label>رمز عبور</label><br>
            <input type="password" name="password" class="left-to-right-input"><br>
            <label>مددجو</label>
            <input type="radio" name="type" value="helpseeker">
            <label>راهنما</label>
            <input type="radio" name="type" value="leader">
        </div>
        <div>
            <label>نام خانوادگی</label><br>
            <input type="password" name="lastname"><br>
            <label>ایمیل</label><br>
            <input type="email" name="email" class="left-to-right-input"><br>
            <label>کد ملی</label><br>
            <input type="text" name="identity_code" class="left-to-right-input"><br>
            <label>تکرار رمز عبور</label><br>
            <input type="password" name="password_confirmation" class="left-to-right-input"><br>
        </div> 
        <div>
            <button type="submit" class="signup-btn">ثبت‌نام</button>
        </div>
    </form>
    <img src="{{ URL::to('/assets/images/sign-up.png') }}" class="signup-img">
</div>
@endsection

@extends('templates.footer')