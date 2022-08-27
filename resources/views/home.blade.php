@extends('base')
@extends('templates.navbar')

@section('content')
    <div class="first-container">
        <div class="first-pic-container">
            <img src="{{ URL::to('/assets/images/massage.png') }}">
        </div>
        <div class="first-txt-container">
            <h1 class="first-haeder-txt">باهم، اعتیاد را ریشه کن کنیم</h1>
            <p class="first-subtxt">هم‌ترک سامانه‌ی ترک اعتیاد به شیوه‌ی راهنما و مددجو. این سامانه کاملا رایگان بوده و رسالتش قدمی هرچند کوچک در راستای بهبود جامعه است.</p>
            <a href="#" class="first-btn">ثبت‌نام</a>
        </div>
    </div>
@endsection

@extends('templates.footer')