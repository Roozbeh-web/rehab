<div>
    <div class="messages-container">
        <div class="people-container">
            @foreach ($chatUsers as $chatUser)
                @if (!is_array($chatUser))
                    @php
                        $chatUser = $chatUsers;
                        $isOne = true;
                        @endphp
                @endif
                @if ($userId == $chatUser['id'])
                    @php
                        $color = 'plum';
                    @endphp
                @else
                    @php
                        $color = null;
                    @endphp
                @endif
                <div wire:click="chooseChat({{$chatUser['id']}})" style="background-color: {{$color}}" class="people-card">
                    <div>
                        <img src="storage/{{$chatUser['avatar']}}" alt="leader-img">
                    </div>
                    <div>
                        <h1>{{$chatUser['username']}}</h1>
                        <p>{{$chatUser['first_name']}} {{$chatUser['last_name']}}</p>
                    </div>
                    @if (auth()->user()->unreadMessages($chatUser['id'])->count() !== 0)
                        <div>
                            <p> <span>( {{auth()->user()->unreadMessages($chatUser['id'])->count()}} ) </span> پیام نخوانده</p>
                        </div>
                        
                    @endif
                </div>
                @if (isset($isOne))
                    @break
                @endif
            @endforeach
        </div>
        <div class="dialog-box-container" id="scroll_div">
            @if (!$userId)
                <h1 style="text-align: center">برای شروع چت یک کاربر انتخاب کنید</h1>
            @else
                <div class="dialog-txt-container">
                    @foreach ($messages as $message)
                        @if($message['user_id'] === auth()->id())
                            @php
                                $dir = 'flex-start';
                                $backColor = '#0dec9a';
                            @endphp
                        @else
                            @php
                                $dir = 'flex-end';
                                $backColor = '#04AA6D';
                                @endphp
                        @endif
                        @php
                            $date = new DateTime($message['created_at']);
                            $timezone = new DateTimeZone('(+4:30)');
                            $date = $date->setTimezone($timezone);
                            $date = $date->format('Y-m-d H:i:s');
                        @endphp
                        <p style="align-self: {{$dir}}; background-color: {{$backColor}}" class="dialog-txt">{{$message['body']}}<br>
                            <span>{{$date}}</span>
                        </p>
                    @endforeach
                </div>
                <textarea wire:model.debounce="input" wire:keydown.enter="sendMessage" class="dialog-input" placeholder="پیامی بنویسید"></textarea>
            @endif
        </div>
    </div>
</div>
