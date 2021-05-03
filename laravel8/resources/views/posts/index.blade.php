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
                    <x-card>
                        <x-slot name="title">
                            Most Commented
                        </x-slot>
                        <x-slot name="subtitle">
                            What people are currently talking about
                        </x-slot>
                        <x-slot name="items">
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </x-slot>
                    </x-card>
                </div>

                <div class="row mb-4">
                    <x-card :title="'Most Active Users'" :subtitle="'Users with most posts written'"
                        :items="collect($mostActiveUsers)->pluck('name')" />

                </div>

                <div class="row">
                    <x-card :title="'Most Active Last Month'" :subtitle="'Users with most posts written in the last month'"
                        :items="collect($mostActiveUsersLastMonth)->pluck('name')" />

                </div>

            </div>
        </div>
    </div>
@endsection
