<div>
    <div>
        @if(session()->has('message'))
        <div class="p-3 text-green-800 bg-green-300 rounded shadow-sm">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <form class="flex my-4" wire:submit.prevent='addComment'>
        <input wire:model.lazy="newComment" type="text" class='w-full p-2 my-2 mr-2 border rounded shadow' placeholder="코멘트...">
        @error('newComment')
        <div>
            <span class="text-red-900">{{$message}}</span>
        </div>
        @enderror
        <button class="btn btn-warning shadow">Add</button>
    </form>
    <span>{{$newComment}}</span>
    @foreach($comments as $comment)
    <div class="card shadow-xl image-full">
        <figure>
            @if($comment->image)
                <img src="{{ $comment->image }}">
            @else
                <img src="https://papago.naver.com/97ec80a681e94540414daf2fb855ba3b.svg">
            @endif
        </figure> 
        <div class="justify-end card-body">
            {{-- <h2 class="card-title">Image overlay</h2>  --}}
            <p>{{ $comment->content }}</p> 
            <p>{{ $comment->writer->name }}</p> 
            <p>{{ $comment->created_at->diffForHumans() }}</p> 
            <div class="card-actions">
                <button class="btn btn-primary">Get Started</button>
            </div>
            <span style="font-size: 48px; color: Dodgerblue">
                <i wire:click="$emit('deleteClicked',{{$comment->id}})" class="fas fa-times hover:text-red-600"></i>
            </span>
            
        </div>
    </div> 
    @endforeach
    {{ $comments->links()}}
</div>
{{-- php artisan make:livewire comments --}}
 <script>
    window.Livewire.on('deleteClicked',(commentId)=>{
        if(confirm('ㄲㄲㄲㄲㄲㄲ')){
            window.Livewire.emit('deleteClk',commentId);
        };
    });
 </script>