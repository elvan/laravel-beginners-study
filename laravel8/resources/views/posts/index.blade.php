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
        {{-- @break($key == 2) --}}
        {{-- @continue($key == 1) --}}
        @if ($loop->even)
            <div>{{ $key }}. {{ $post['title'] }}</div>
        @else
            <div style="background-color: silver">{{ $key }}. {{ $post['title'] }}</div>
        @endif

    @empty
        No posts found!
    @endforelse
@endsection
