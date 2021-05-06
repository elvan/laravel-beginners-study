@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>
                {{ $post->title }}
                @php
                    $show = now()->diffInMinutes($post->created_at) < 5;
                @endphp
                <x-badge type="success" :message="'New'" :show="$show" />
            </h1>

            @if ($post->image)
                <img class="img-fluid rounded mb-3" src="{{ $post->image->url() }}" alt="{{ $post->title }}">
            @endif

            <?php $paragraphs = preg_split('#\R+#', $post->content); ?>
            @foreach ($paragraphs as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach

            <x-updated :date="$post->created_at" :name="$post->user->name" :userId="$post->user->id" />

            <x-tags :tags="$post->tags" />

            <p>Currently read by {{ $counter }} people</p>

            @include('comments._form')

            <h4>Comments</h4>
            <div>
                @forelse ($post->comments as $comment)
                    <?php $lines = preg_split('#\R+#', $comment->content); ?>
                    @foreach ($lines as $line)
                        <p>{{ $line }}</p>
                    @endforeach

                    <x-updated :date="$comment->created_at" :name="$comment->user->name" />

                    <hr>
                @empty
                    <p>No comments yet!</p>
                @endforelse
            </div>

        </div>

        <div class="col-4">
            @include('posts._activity')
        </div>

    </div>
@endsection
