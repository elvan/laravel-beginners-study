@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}" alt="user image"
                class="img-fluid img-thumbnail avatar rounded">
        </div>

        <div class="col-8">
            <h3>{{ $user->name }}</h3>
            <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user]) }}">Edit profile</a>
        </div>
    </div>
@endsection
