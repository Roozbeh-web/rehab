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
            @endif
            
        </div>
    </form>
</div>
