@extends('base')
@extends('templates.navbar')

@section('content')
    <div class="form-container">
        <img src="{{ URL::to('/assets/images/sign-in.png') }}" class="signin-img">
        <form action="/sign-in" class="signin-form" method="POST">
            <h1>ورود</h1>
            @if (session()->get('error'))
                <div class="error-txt">
                    {{ session()->get('error') }}
                </div>
            @endif
            @csrf
            <label>نام کاربری</label><br>
            @error('username')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="text" name="username"><br>
            <label>رمز عبور</label><br>
            @error('password')
                <div class="error-txt">{{ $message }}</div>
            @enderror
            <input type="password" name="password"><br>
            <button type="submit" class="signin-btn">ورود</button>
        </form>
    </div>
@endsection

@extends('templates.footer')