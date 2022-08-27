@extends('base')
@extends('templates.navbar')

@section('content')
    <div class="form-container">
        <img src="{{ URL::to('/assets/images/sign-in.png') }}" class="signin-img">
        <form action="post" class="signin-form">
            <h1>ورود</h1>
            @csrf
            <label>نام کاربری</label><br>
            <input type="text" name="username"><br>
            <label>رمز عبور</label><br>
            <input type="password" name="password">
        </form>
    </div>
@endsection

@extends('templates.footer')