<div class="edit-profile-container">    
    <h1>ویرایش مشخصات</h1>
    @if ($msg)
    <span style="color: {{$color}}">
        {{ $msg }}
    </span>
    @endif
    @if (session()->get('msg'))
    <span style="color: {{$color}}">
        {{ session()->get('msg') }}
    </span>
@endif

    <form  wire:submit.prevent="makeChange" enctype="multipart/form-data" class="edit-profile-form">
        <div>
            @csrf
            <label>نام</label><br>
            @error('firstName')
                <span class="error" style="color: red">{{ $message }}</span><br>
            @enderror
            <input wire:model="firstName" type="text" name="firstname" placeholder={{$user['first_name']}}><br>
            <label>رمز عبور</label><br>
            @error('password')
                <span class="error" style="color: red">{{ $message }}</span><br>
            @enderror
            <input type="password" name="password" wire:model="password"><br>
            <label>شماره تماس</label><br>
            @error('phone')
                <span class="error" style="color: red">{{ $message }}</span><br>
            @enderror
            <input type="text" name="phone" wire:model="phone" placeholder={{$user['phone']}}><br>
            <button type="submit" class="profile-btn btn">ثبت‌</button>
        </div>
        <div>
            <label>نام خانوادگی</label><br>
            @error('lastName')
                <span class="error" style="color: red">{{ $message }}</span><br>
            @enderror
            <input type="text" name="lastname" wire:model="lastName" placeholder="{{$user['last_name']}}"><br>
            <label>تکرار رمز عبور</label><br>
            <input type="password" name="password_confirmation" wire:model="password_confirmation"><br>
            <label>عکس</label><br>
            @error('avatar')
                <span class="error" style="color: red">{{ $message }}</span><br>
            @enderror
            <input type="file" wire:model="avatar"><br>
        </div>
    </form>
</div>
