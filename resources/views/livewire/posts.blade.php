<div class="post-container">
    @foreach ($posts as $post)
        <div class="card-container">
            <div class="image-container">
                <img src="storage/{{$post->image}}" alt="post-img" class="post-img">
            </div>
            <div class="title-container">
                <h1>{{$post->title}}</h1>
            </div>
            <div class="body-container">
                <p>{{$post->body}}</p>
            </div>
            <div class="post-detail-container">
                <p>{{$post->created_at}}</p>
            </div>
        </div>
    @endforeach
</div>
