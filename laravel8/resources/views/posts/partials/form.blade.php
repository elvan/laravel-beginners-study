<div><input name="title" type="text" value="{{ old('title', optional($post ?? null)->title) }}"></div>
@error('title')
    <div>{{ $message }}</div>
@enderror
<div>
    <textarea name="content" id="content" rows="10">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
