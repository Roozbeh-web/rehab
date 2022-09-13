<div>
    @foreach ($leaders as $leader)
        <div class="leader-container">
            <div class="leader-card-container">
                <div class="leader-card-col">
                    <div class="leader-card-row1">
                        <div class="leader-img-container">
                            <img src="storage/{{$leader->profile->image}}" alt="leader-img">
                        </div>
                        <div class="leader-bio-container">
                            <p>{{$leader->profile->bio}}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="leader-card-col">
                    <div class="leader-card-row">
                        <div class="leader-username-container">
                            <span><h1>{{$leader->username}}</h1></span>
                        </div>
                        <div class="leader-name-container">
                            <span><p>{{$leader->first_name}} {{$leader->last_name}}</p></span>
                        </div>
                        <div class="leader-quit-container">
                            @php
                                $quitDate = new DateTime($leader->profile->quit_date);
                                $now = new DateTime();
                                $interval = $now->diff($quitDate)->y;

                            @endphp
                            <span><p>مدت پاکی: {{$interval}} سال</p></span>
                        </div>
                        <div class="leader-loc-container">
                            <p>استان: {{$leader->province}}</p>
                            <p>شهر: {{$leader->city}}</p>
                        </div>
                        <div >
                            <button class="btn leader-request-btn">ارسال درخواست</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
