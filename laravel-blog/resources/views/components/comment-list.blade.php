@props(['comments'])

@forelse ($comments as $comment)
    <?php $lines = preg_split('#\R+#', $comment->content); ?>
    @foreach ($lines as $line)
        <p>{{ $line }}</p>
    @endforeach

    <x-tags :tags="$comment->tags" />

    <x-updated :date="$comment->created_at" :name="$comment->user->name" :userId="$comment->user->id" />

    <hr>
@empty
    <p>No comments yet!</p>
@endforelse
