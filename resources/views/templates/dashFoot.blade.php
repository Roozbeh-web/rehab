@section('footer')
<div class="footer">
    <div class="footer-txt">
        <h1>هم‌ترک</h1>
    </div>
    <div class="dash-footer-link">
        <div class="dash-footer-link-divider">
            <a href={{ route('dashboard') }} class="footer-link-item">خانه</a>
            <a href="#" class="footer-link-item">پیام ها</a>
            <a href="#" class="footer-link-item">خروج</a>
        </div>
        <div class="dash-footer-link-divider">
            @if (auth()->user()->type === 'helpseeker')
                <a href={{ route('leaders') }} class="footer-link-item">راهنما</a>
                <a href="#" class="footer-link-item">برنامه</a>
            @else
                <a href={{ route('requests') }} class="footer-link-item">درخواست</a>
                <a href={{ route('helpseekers') }} class="footer-link-item">مددجویان</a>
            @endif
        </div>
    </div>
</div>
@endsection