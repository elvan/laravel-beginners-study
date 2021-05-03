@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>
        {{ $post->title }}
        @php
            $show = now()->diffInMinutes($post->created_at) < 5;
        @endphp
        <x-badge type="success" :message="'New'" :show="$show" />
    </h1>

    <?php $paragraphs = preg_split('#\R+#', $post->content); ?>
    @foreach ($paragraphs as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

    <p class="text-muted">Added {{ $post->created_at->diffForHumans() }}</p>

    <h4>Comments</h4>
    <div>
        @forelse ($post->comments as $comment)
            <?php $lines = preg_split('#\R+#', $comment->content); ?>
            @foreach ($lines as $line)
                <p>{{ $line }}</p>
            @endforeach

            <p class="text-muted"> added {{ $comment->created_at->diffForHumans() }}</p>
            <hr>
        @empty
            <p>No comments yet!</p>
        @endforelse
    </div>

@endsection
