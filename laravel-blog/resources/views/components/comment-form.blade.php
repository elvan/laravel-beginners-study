@props(['route'])

<x-errors></x-errors>

<div class="mt-2 mb-2">
    @auth
        <form action="{{ $route }}" method="POST">
            @csrf

            <div>
                <div class="form-group">
                    <label for="content">Say something</label>
                    <textarea class="form-control" name="content" id="content" rows="15"></textarea>
                </div>

                <button class="btn btn-primary btn-block" type="submit">Add comment</button>
            </div>
        </form>
    @else
        <a href="{{ route('login') }}">Sign in</a> to post comments
    @endauth
</div>
