<div>
    @if ($leader)
    <div class="notice-container specific-leader">
        <h1>در حال حاضر راهنمای شما {{$leader['username']}} است</h1>
    </div>
        <div class="leader-container">
            <div class="leader-card-container ">
                <div class="leader-card-col">
                    <div class="leader-card-row1">
                        <div class="leader-img-container">
                            <img src="storage/{{$leader['avatar']}}" alt="leader-img">
                        </div>
                        <div class="leader-loc-container">
                            <p>شماره همراه: {{$leader['phone']}}</p>
                            <p>ایمیل: {{$leader['email']}}</p>
                        </div>
                        @if ($leader['bio'])
                            <div class="leader-bio-container">
                                <p>{{$leader['bio']}}</p>
                            </div>            
                        @endif
                        </div>
                    </div>
                <div class="leader-card-col">
                    <div class="leader-card-row">
                        <div class="leader-username-container">
                            <span><h1>{{$leader['username']}}</h1></span>
                        </div>
                        <div class="leader-name-container">
                            <span><p>{{$leader['first_name']}} {{$leader['last_name']}}</p></span>
                        </div>
                        <div class="leader-quit-container">
                            @php
                                $quitDate = new DateTime($leader['quit_date']);
                                $birthDate = new DateTime($leader['birth_date']);
                                $now = new DateTime();
                                    
                                $quitInterval = $now->diff($quitDate)->y;
                                $ageInterval = $now->diff($birthDate)->y;


                            @endphp
                            <span><p>مدت پاکی: {{$quitInterval}} سال</p></span>
                        </div>
                        <div class="leader-quit-container">
                            <span><p>سن: {{$ageInterval}} سال</p></span>
                        </div>
                        <div class="leader-loc-container">
                            <p>استان: {{$leader['province']}}</p>
                            <p>شهر: {{$leader['city']}}</p>
                        </div>
                        <div >
                            <button wire:click="cancelRequest({{$leader['id']}})" class="btn leader-request-btn">ارسال پیام</button>
                            <button wire:click="cancelRequest({{$leader['id']}})" class="btn leader-cancel-btn">حذف راهنما</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

        <div class="search-container" >
            <label>جستجو:</label>
            <input type="text" wire:model="search">
        </div>
        <div class="warn-container">
                <span>توجه: </span>
                <p> وقتی یک راهنما درخواست شما را قبول کند دیگر نمیتوانید لیست راهنما ها را مشاهده کنید مگر ارتباط خود را با راهنمایتان قطع کنید. </p>
        </div>
        @foreach ($leaders as $lead)
            @if ($lead['status'] !== 'block')
            <div class="leader-container">
                <div class="leader-card-container">
                    <div class="leader-card-col">
                        <div class="leader-card-row1">
                            <div class="leader-img-container">
                                <img src="storage/{{$lead['avatar']}}" alt="leader-img">
                            </div>
                            @if ($lead['bio'])
                                <div class="leader-bio-container">
                                    <p>{{$lead['bio']}}</p>
                                </div>                        
                            @endif
                        </div>
                    </div>
                    <div class="leader-card-col">
                        <div class="leader-card-row">
                            <div class="leader-username-container">
                                <span><h1>{{$lead['username']}}</h1></span>
                            </div>
                            <div class="leader-name-container">
                                <span><p>{{$lead['first_name']}} {{$lead['last_name']}}</p></span>
                            </div>
                            <div class="leader-quit-container">
                                @php
                                    $quitDate = new DateTime($lead['quit_date']);
                                    $birthDate = new DateTime($lead['birth_date']);
                                    $now = new DateTime();
                                        
                                    $quitInterval = $now->diff($quitDate)->y;
                                    $ageInterval = $now->diff($birthDate)->y;


                                @endphp
                                <span><p>مدت پاکی: {{$quitInterval}} سال</p></span>
                            </div>
                            <div class="leader-quit-container">
                                <span><p>سن: {{$ageInterval}} سال</p></span>
                            </div>
                            <div class="leader-loc-container">
                                <p>استان: {{$lead['province']}}</p>
                                <p>شهر: {{$lead['city']}}</p>
                            </div>
                            <div >
                                @php
                                    $cancelBtnCreated = false;
                                @endphp
                                @if($requests->all())
                                    @foreach ($requests as $request)
                                        @if ($lead['id'] === $request->leader_id)
                                            <button wire:click="cancelRequest({{$lead['id']}})" class="btn leader-cancel-btn">لغو درخواست</button>
                                            @php
                                                    $cancelBtnCreated = true;   
                                            @endphp
                                        @endif
                                    @endforeach
                                        @if(!$cancelBtnCreated)
                                            <button wire:click="sendRequest({{$lead['id']}})" class="btn leader-request-btn">ارسال درخواست</button>
                                        @endif
                                @else
                                    <button wire:click="sendRequest({{$lead['id']}})" class="btn leader-request-btn">ارسال درخواست</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @endif
</div>
