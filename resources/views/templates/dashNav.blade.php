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
        <a href={{ route('posts') }} class="nav-link-item">پست ها</a>
        @if (auth()->user()->type === 'helpseeker')
            <a href="#" class="nav-link-item">راهنما</a>
            <a href="#" class="nav-link-item">برنامه</a>
        @else
            <a href="#" class="nav-link-item">درخواست ها</a>
            <a href="#" class="nav-link-item">مددجویان</a>
        @endif
        <a href="#" class="nav-link-item">پیام ها</a>
        <a href={{ route('logout') }} class="nav-link-item">خروج</a>
    </div>
</div>
@endsection