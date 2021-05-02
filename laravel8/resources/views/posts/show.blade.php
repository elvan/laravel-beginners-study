@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p class="text-muted">Added {{ $post->created_at->diffForHumans() }}</p>

    @if (now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New</div>
    @endif

    <h4>Comments</h4>
    <div>
        @forelse ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            <p class="text-muted"> added {{ $comment->created_at->diffForHumans() }}</p>
            <hr>
        @empty
            <p>No comments yet!</p>
        @endforelse
    </div>

@endsection
