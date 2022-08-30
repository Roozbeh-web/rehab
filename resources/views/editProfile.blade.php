@extends('base')
@extends('templates.dashNav')

@section('content')
    <div class="edit-profile-container">
        <h1>ویرایش مشخصات</h1>
        <form action="/edit-profile" method="POST" enctype="multipart/form-data" class="edit-profile-form">
            <div>
                <label>نام</label><br>
                <input type="text" name="firstname"><br>
                <label>رمز عبور</label><br>
                <input type="password" name="password"><br>
                <label>شماره تماس</label><br>
                <input type="text" name="phone"><br>
                <button type="submit" class="profile-btn btn">ثبت‌</button>
            </div>
            <div>
                <label>نام خانوادگی</label><br>
                <input type="text" name="lastname"><br>
                <label>تکرار رمز عبور</label><br>
                <input type="password" name="password_confirmation"><br>
                <label>عکس</label><br>
                <input type="file" name="avatar"><br>
            </div>
        </form>
    </div>
@endsection


@extends('templates.dashFoot')