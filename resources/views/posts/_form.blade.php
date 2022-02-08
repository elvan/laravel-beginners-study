<x-errors></x-errors>

<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
        value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
        rows="15">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input class="form-control-file @error('thumbnail') is-invalid @enderror" name="thumbnail" type="file">
</div>
