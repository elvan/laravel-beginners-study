@extends('layouts.app')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" required type="text" value="">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" required type="email" value="">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" required type="password" value="">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" name="password_confirmation" required type="password" value="">
        </div>

        <button class="btn btn-primary btn-block" type="submit">Register</button>

    </form>
@endsection
