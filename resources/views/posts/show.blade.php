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

            <x-comment-form :route="route('posts.comments.store', ['post' => $post])"></x-comment-form>

            <h4>Comments</h4>
            <div>
                <x-comment-list :comments="$post->comments"></x-comment-list>
            </div>

        </div>

        <div class="col-4">
            @include('posts._activity')
        </div>

    </div>
@endsection
