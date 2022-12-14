@extends('base')
@extends('templates.navbar')

@section('content')
<h1 class="signup-header-txt">ثبت‌نام</h1>

<div class="form-container signup">
    <form action="/sign-up" class="signup-form" method="POST">
        <div class="signup-form-inner-container">
            @csrf
            <label>نام</label><br>
            @error('firstname')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="firstname" value="{{old('firstname')}}"><br>
            <label>نام کاربری</label><br>
            @error('username')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="username" value="{{old('username')}}"><br>
            <label>شماره همراه</label><br>
            @error('phone')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="phone" class="left-to-right-input" value="{{old('phone')}}"><br>
            <label>رمز عبور</label><br>
            @error('password')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="password" name="password" class="left-to-right-input"><br>
            <div class="ir-select">
                <label>محل زندگی</label><br>
                @error('city')
                    <span class="error-txt">{{ $message }}</span><br>
                @enderror
                <select class="ir-province" name="province"></select>
                <select class="ir-city" name="city"></select><br>
            </div>
            @error('type')
            <div class="error-txt">{{ $message }}</div>
            @enderror
            <label>مددجو</label>
            <input type="radio" name="type" value="helpseeker">
            <label>راهنما</label>
            <input type="radio" name="type" value="leader"><br>
        </div>
        <div>
            <label>نام خانوادگی</label><br>
            @error('lastname')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="lastname" value="{{old('lastname')}}"><br>
            <label>ایمیل</label><br>
            @error('email')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="email" name="email" class="left-to-right-input" value="{{old('email')}}"><br>
            <label>کد ملی</label><br>
            @error('identity_code')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="identity_code" class="left-to-right-input" value="{{old('identity_code')}}"><br>
            <label>تکرار رمز عبور</label><br>
            <input type="password" name="password_confirmation" class="left-to-right-input"><br>
            
            <button type="submit" class="signup-btn">ثبت‌نام</button>
        </div> 
        <div>
        </div>
    </form>
    <img src="{{ URL::to('/assets/images/sign-up.png') }}" class="signup-img">
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" defer></script>
    <script src="https://github.com/KayvanMazaheri/ir-city-select/releases/download/v0.2.0/ir-city-select.min.js" defer></script>
@extends('templates.footer')