@section('navbar')
<div class="nav">
    <div>
        <a href={{ route('edit-profile') }}>
            <h1 class="nav-header-txt">
                <img src="storage/{{auth()->user()->profile->image}}" alt="" width="36px">
                {{ auth()->user()->username }}
                <span class="user-type-txt">
                    @if (auth()->user()->type === 'helpseeker')
                    (مددجو) 
                    @else
                    (راهنما)
                    @endif
                </span>
                <i class="fa-solid fa-pen fa-2xs"></i>
            </h1>
        </a>
    </div>
    <div class="nav-link">
        <a href={{ route('dashboard') }} class="nav-link-item">خانه</a>
        @if (auth()->user()->type === 'helpseeker')
            <a href={{ route('leaders') }} class="nav-link-item">راهنما</a>
            <a href="#" class="nav-link-item">برنامه</a>
        @else
            <a href={{ route('requests') }} class="nav-link-item">درخواست ها</a>
            <a href={{ route('helpseekers') }} class="nav-link-item">مددجویان</a>
        @endif
        <a href={{ route('messages') }} class="nav-link-item">پیام ها({{auth()->user()->unreadMessages->count()}})</a>
        <a href={{ route('logout') }} class="nav-link-item">خروج</a>
    </div>
</div>
@endsection