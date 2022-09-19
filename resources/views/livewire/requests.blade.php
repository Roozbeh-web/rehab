<div>
    @if (empty($helpseekers) && !$reachLimit)
        <div class="notice-container">
            <h1>درخواستی وجود ندارد</h1>
        </div>
    @endif
    @if ($reachLimit)
        <div class="notice-container">
            <h1>نمی‌توانید بیش از پنج مددجو داشته باشید</h1>
        </div>
    @else
        @foreach ($helpseekers as $helpseeker)
            <div class="leader-container">
                <div class="leader-card-container">
                    <div class="leader-card-col">
                        <div class="leader-card-row1">
                            <div class="leader-img-container">
                                <img src="storage/{{$helpseeker['avatar']}}" alt="leader-img">
                            </div>
                            <div class="leader-bio-container">
                                <p>{{$helpseeker['bio']}}</p>
                            </div>   
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
                            <div class="leader-loc-container">
                                <p>استان: {{$helpseeker['province']}}</p>
                                <p>شهر: {{$helpseeker['city']}}</p>
                            </div>   
                            <div>
                                <span>مواد مورد مصرف:
                                    @foreach($helpseeker['drugs'] as $drug)
                                        {{$drug['name']}}.
                                    @endforeach
                                    <div class="btn-container">
                                        <div>
                                            <button wire:click="sendRequest({{ $helpseeker['id']}}, 'accept')" class="btn helpseeker-request-btn">قبول درخواست</button>
                                        </div>
                                        <div>
                                            <button wire:click="sendRequest({{ $helpseeker['id']}}, 'reject')" class="btn helpseeker-cancel-btn">رد درخواست</button>
                                        </div>
                                    </div>
                                    <div>
                                        <a wire:click="sendRequest({{ $helpseeker['id']}}, 'block')" class="block-linkbtn">بلاک</a>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach
    @endif
</div>
