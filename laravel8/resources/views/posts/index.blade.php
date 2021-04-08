@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    {{-- @if (count($posts))
        @foreach ($posts as $key => $post)
            <div>{{ $key }}. {{ $post['title'] }}</div>
        @endforeach
    @else
        No posts found!
    @endif --}}

    @forelse ($posts as $key => $post)
        @include('posts.partials.post')
    @empty
        No posts found!
    @endforelse
@endsection
