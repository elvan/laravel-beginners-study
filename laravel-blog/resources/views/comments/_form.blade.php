<x-errors></x-errors>

<div class="mt-2 mb-2">
    @auth
        <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="POST">
            @csrf

            <div>
                <div class="form-group">
                    <label for="content">Say something</label>
                    <textarea class="form-control" name="content" id="content" rows="15"></textarea>
                </div>

                <input class="btn btn-primary btn-block" type="submit" value="Add comment">
            </div>
        </form>
    @else
        <a href="{{ route('login') }}">Sign in</a> to post comments
    @endauth
</div>
