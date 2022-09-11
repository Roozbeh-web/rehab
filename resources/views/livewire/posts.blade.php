<div class="post-container">
    <div class="modal" style="{{$modalStyle}}">
        <span wire:click="removeModal({{false}})" class="close" title="Close Modal">&times;</span>
        {{-- <form class="modal-content"> --}}
            <div class="container">
                <h1>حذف پست</h1>
                <p>آیا میخواهید پست را حذف کنید؟</p>
        
                <div class="clearfix">
                    <button wire:click="removeModal({{false}})" class="cancelbtn">خیر</button>
                    <button wire:click="remove" class="deletebtn">بله</button>
                </div>
            </div>
        {{-- </form> --}}
    </div>
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
                            <button wire:click="doCollapse({{$post->id}})" class="collapse-btn"><i class="fa-sharp fa-solid fa-arrow-up"></i></button>
                        </p>
                    @else
                        <p> {{ \Illuminate\Support\Str::limit(strip_tags($post->body, 150)) }}
                        <button wire:click="doCollapse({{$post->id}})" class="collapse-btn"><i class="fa-sharp fa-solid fa-arrow-down"></i></button>
                    @endif
                 </p>
            </div>
            <div class="post-detail-container">
                <p class="left-to-right-input">{{$post->created_at}}</p>
            </div>
            <div>
                <button wire:click="edit({{$post->id}})" class="btn btn-edit">ویرایش</button>
                <button wire:click="removeModal({{ $post->id }}, {{ $post->id}})" class="btn btn-danger">حذف</button>
            </div>
        </div>
    @endforeach
</div>
