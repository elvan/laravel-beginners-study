<h3>
    @if ($post->trashed())
        <del>
    @endif
    <a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('posts.show', ['post' => $post->id]) }}">
        {{ $post->title }}
    </a>
    @if ($post->trashed())
        </del>
    @endif
</h3>

<x-updated :date="$post->created_at" :name="$post->user->name" :userId="$post->user->id" />

<x-tags :tags="$post->tags" />

@if ($post->comments_count)
    <p>
        {{ $post->comments_count }} comments
    </p>
@else
    <p>
        No comments yet
    </p>
@endif
