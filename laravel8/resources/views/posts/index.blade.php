@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $key => $post)
                @include('posts.partials.post')
            @empty
                No blog posts yet!
            @endforelse
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                What people are currently talking about
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active Users</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Users with most posts written
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveUsers as $user)
                                <li class="list-group-item">
                                    <a href="#{{ $user->id }}">
                                        {{ $user->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
