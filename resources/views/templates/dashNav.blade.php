@section('navbar')
<div class="nav">
    <div>
        <a href="#">
            <h1 class="nav-header-txt">
                <i class="fa-solid fa-pen fa-2xs"></i>
                 {{ auth()->user()->username }}
                <span class="user-type-txt">
                @if (auth()->user()->type === 'helpseeker')
                    (مددجو) 
                @else
                    (راهنما)
                @endif
                </span>
            </h1>
        </a>
    </div>
    <div class="nav-link">
        <a href="#" class="nav-link-item">خانه</a>
        <a href="#" class="nav-link-item">پست ها</a>
        <a href="#" class="nav-link-item">راهنما</a>
        <a href="#" class="nav-link-item">پیام ها</a>
        <a href="#" class="nav-link-item">برنامه</a>
        <a href="#" class="nav-link-item">خروج</a>
    </div>
</div>
@endsection