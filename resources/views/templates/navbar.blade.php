@section('navbar')
    <div class="nav">
        <div>
            <a href={{ route('home') }}><h1 class="nav-header-txt">هم‌ترک</h1></a>
        </div>
        <div class="nav-link">
            <a href={{ route('signin') }} class="nav-link-item">ورود</a>
            <a href={{ route('signup') }} class="nav-link-item">ثبت‌نام</a>
            <a href="#" class="nav-link-item">درباره ما</a>
            <a href="#" class="nav-link-item">تماس با ما</a>
        </div>
    </div>
@endsection