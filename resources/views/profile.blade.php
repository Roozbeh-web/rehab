@extends('base')

@section('content')
    <div class="profile-container">
        <h1>تکمیل مشخصات کاربری</h1>
        <form action="/profile" method="post" class="profile-form" enctype="multipart/form-data">
            @csrf
            <div>
                <label>درباره من</label><br>
                <textarea name="bio" cols="30" rows="10" >{{old('bio')}}</textarea><br>
                <label>تاریخ تولد</label><br>
                @error('birthdate')
                    <span class="error-txt">{{ $message }}</span><br>
                @enderror
                <input type="date" name="birthdate" value="{{old('birthdate')}}"><br>
            </div>
            <div class="ir-select">
                <label>محل زندگی</label><br>
                @error('city')
                    <span class="error-txt">{{ $message }}</span><br>
                @enderror
                <select class="ir-province" name="province"></select>
                <select class="ir-city" name="city"></select><br>
                <label>عکس</label><br>
                @error('avatar')
                    <span class="error-txt">{{ $message }}</span><br>
                @enderror
                <input type="file" name="avatar"><br>
                @if(auth()->user()->type == "leader")
                    <label>مدارک شناسایی (به صورت عکس)</label><br>
                    @error('documents')
                        <span class="error-txt">{{ $message }}</span><br>
                    @enderror
                    @if (session()->get('error'))
                        <span class="error-txt">
                            {{ session()->get('error') }}
                        </span><br>
                    @endif
                    <input type="file" name="documents[]" multiple><br>
                    <label>تاریخ ترک</label><br>
                    @error('quit_date')
                        <span class="error-txt">{{ $message }}</span><br>
                    @enderror
                    <input type="date" name="quit_date" value="{{old('quit_date')}}"><br>
                @endif
                <button class="profile-btn btn" type="submit">ثبت</button>
            </div>
            <div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" defer></script>
    <script src="https://github.com/KayvanMazaheri/ir-city-select/releases/download/v0.2.0/ir-city-select.min.js" defer></script>
    @endsection
