<div>
    @foreach ($requests as $request)
        <div class="leader-container">
            <div class="leader-card-container">
                <div class="leader-card-col">
                    <div class="leader-card-row1">
                        <div class="leader-img-container">
                            <img src="storage/{{$request->helpseeker->profile->image}}" alt="leader-img">
                        </div>
                        <div class="leader-bio-container">
                            <p>{{$request->helpseeker->profile->bio}}</p>
                        </div>   
                    </div>
                </div>
                <div class="leader-card-col">
                    <div class="leader-card-row">
                        <div class="leader-username-container">
                            <span><h1>{{$request->helpseeker->username}}</h1></span>
                        </div>
                        <div class="leader-name-container">
                            <span><p>{{$request->helpseeker->first_name}} {{$request->helpseeker->last_name}}</p></span>
                        </div>
                        <div class="leader-loc-container">
                            <p>استان: {{$request->helpseeker->province}}</p>
                            <p>شهر: {{$request->helpseeker->city}}</p>
                        </div>   
                        <div>
                            <span>مواد مورد مصرف:
                                @foreach($request->helpseeker->drugs->toArray() as $drug)
                                    {{$drug['name']}}
                                @endforeach
                                <div class="btn-container">
                                    <div>
                                        <button class="btn helpseeker-request-btn">قبول درخواست</button>
                                    </div>
                                    <div>
                                        <button class="btn helpseeker-cancel-btn">رد درخواست</button>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
</div>
