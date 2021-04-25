@if ($loop->even)
    <div>{{ $key + 1 }}. {{ $post->title }}</div>
@else
    <div style="background-color: silver">{{ $key + 1 }}. {{ $post->title }}</div>
@endif

<div>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete!" />
    </form>
</div>
