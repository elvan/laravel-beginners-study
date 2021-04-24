@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        <div><input name="title" type="text"></div>
        <div><textarea name="content" id="content" cols="30" rows="10"></textarea></div>
        <div><input type="submit" value="Create"></div>
    </form>
@endsection
