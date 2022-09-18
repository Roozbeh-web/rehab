<div>
    <div class="search-container" >
        <label>جستجو:</label>
        <input type="text" wire:model="search">
    </div>
    <div class="warn-container">
            <span>توجه: </span>
            <p> وقتی یک راهنما درخواست شما را قبول کند دیگر نمیتوانید لیست راهنما ها را مشاهده کنید مگر ارتباط خود را با راهنمایتان قطع کنید. </p>
    </div>
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
                                @php
                                    $cancelBtnCreated = false;
                                @endphp
                                @if($requests->all())
                                    @foreach ($requests as $request)
                                        @if ($leader->id === $request->leader_id)
                                            <button wire:click="cancelRequest({{$leader->id}})" class="btn leader-cancel-btn">لغو درخواست</button>
                                            @php
                                                $cancelBtnCreated = true;   
                                            @endphp
                                        @endif

                                    @endforeach
                                        @if(!$cancelBtnCreated)
                                            <button wire:click="sendRequest({{$leader->id}})" class="btn leader-request-btn">ارسال درخواست</button>
                                        @endif
                                @else
                                    <button wire:click="sendRequest({{$leader->id}})" class="btn leader-request-btn">ارسال درخواست</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
</div>
