@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    @isset($post['has_comments'])
        <div>The post has some comments... using isset</div>
    @endisset
@endsection
