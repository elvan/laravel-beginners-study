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

<x-updated :date="$post->created_at" :name="$post->user->name" />

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

<div class="mb-3">
    @auth
        @can('update', $post)
            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                Edit
            </a>
        @endcan
        @can('delete', $post)
            @unless($post->trashed())
                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" type="submit" value="Delete" />
                </form>
            @endunless
        @endcan
    @endauth
</div>
