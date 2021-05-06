@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="" alt="user image" class="img-thumbnail avatar rounded">
        </div>

        <div class="col-8">
            <h3>{{ $user->name }}</h3>
        </div>
    </div>
@endsection
