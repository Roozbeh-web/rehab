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
                    <img src="storage/{{$chatUser['avatar']}}" alt="leader-img">
                    <div>
                        <h1>{{$chatUser['username']}}</h1>
                        <p>{{$chatUser['first_name']}} {{$chatUser['last_name']}}</p>
                    </div>
                </div>
                @if (isset($isOne))
                    @break
                @endif
            @endforeach
        </div>
        <div class="dialog-box-container">
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
                        <p style="align-self: {{$dir}}; background-color: {{$backColor}}" class="dialog-txt">{{$message['body']}}</p>
                    @endforeach
                </div>
                <textarea wire:model.debounce="input" wire:keydown.enter="sendMessage" class="dialog-input" placeholder="پیامی بنویسید"></textarea>
            @endif
        </div>
    </div>
</div>