<div>
    @foreach ($helpseekers as $helpseeker)
        <div class="leader-container">
            <div class="leader-card-container ">
                <div class="leader-card-col">
                    <div class="leader-card-row1">
                        <div class="leader-img-container">
                            <img src="storage/{{$helpseeker['avatar']}}" alt="leader-img">
                        </div>
                        <div class="leader-loc-container">
                            <p>شماره همراه: {{$helpseeker['phone']}}</p>
                            <p>ایمیل: {{$helpseeker['email']}}</p>
                        </div>
                        @if ($helpseeker['bio'])
                            <div class="leader-bio-container">
                                <p>{{$helpseeker['bio']}}</p>
                            </div>            
                        @endif
                        </div>
                    </div>
                <div class="leader-card-col">
                    <div class="leader-card-row">
                        <div class="leader-username-container">
                            <span><h1>{{$helpseeker['username']}}</h1></span>
                        </div>
                        <div class="leader-name-container">
                            <span><p>{{$helpseeker['first_name']}} {{$helpseeker['last_name']}}</p></span>
                        </div>
                        <div class="leader-quit-container">
                            @php
                                $birthDate = new DateTime($helpseeker['birth_date']);
                                $now = new DateTime();
                                    
                                $ageInterval = $now->diff($birthDate)->y;
                            @endphp
                            <span><p>سن: {{$ageInterval}} سال</p></span>
                        </div>
                        <div class="leader-loc-container">
                            <p>استان: {{$helpseeker['province']}}</p>
                            <p>شهر: {{$helpseeker['city']}}</p>
                        </div>
                        <div >
                            <button wire:click="cancelRequest({{$helpseeker['id']}})" class="btn leader-request-btn">ارسال پیام</button>
                            <button wire:click="cancelRequest({{$helpseeker['id']}})" class="btn leader-cancel-btn">حذف مددجو</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
