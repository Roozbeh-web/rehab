@extends('base')

@section('content')
    <div class="profile-container">
        <h1>تکمیل مشخصات کاربری</h1>
        <form action="/new-user-profile" method="post" class="profile-form" enctype="multipart/form-data">
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
                        <label>مواد مورد مصرف</label><br>
                        @error('drugs')
                            <span class="error-txt">{{ $message }}</span><br>
                        @enderror
                        <span class="notice">برای انتخاب چند ماده از ctrl بر روی کیبورد استفاذه کنید</span><br>
                        <select name="drugs[]" multiple>
                            @foreach ($drugs as $drug)
                                <option value={{$drug}}>{{$drug}}</option>
                            @endforeach
                        </select><br>
                        <button class="profile-btn btn" type="submit">ثبت</button>
                    </div>
                    <div>
            </div>
        </form>
    </div>
    
    @endsection
