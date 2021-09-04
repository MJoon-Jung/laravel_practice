<div>
    @foreach ( $comments as $comment )
        <div>
            {{ $comment->content }}
            {{ $comment->user_id }}
        </div>
    @endforeach
</div>