<div class="post-container">
    @foreach ($posts as $post)
        <div class="card-container">
            <div class="title-container">
                <h1>{{$post->title}}</h1>
            </div>
            <div class="image-container">
                <img src="storage/{{$post->image}}" alt="post-img" class="post-img">
            </div>
            <div class="body-container">
                    @if ($collapse == false && $postId == $post->id)
                        <p>
                            {{$post->body}}
                            <button wire:click="doCollapse({{$post->id}})" class="collapse-btn"> کمتر</button>
                        </p>
                    @else
                        <p> {{ \Illuminate\Support\Str::limit(strip_tags($post->body, 150)) }}
                        <button wire:click="doCollapse({{$post->id}})" class="collapse-btn"> بیشتر</button>
                    @endif
                 </p>
            </div>
            <div class="post-detail-container">
                <p class="left-to-right-input">{{$post->created_at}}</p>
            </div>
            <div>
                <button class="btn btn-edit">ویرایش</button>
                <button class="btn btn-danger">حذف</button>
            </div>
        </div>
    @endforeach
</div>
