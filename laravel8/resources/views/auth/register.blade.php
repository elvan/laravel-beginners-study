@extends('layouts.app')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="name" required type="text"
                value="">

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="email" required type="email"
                value="">

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required
                type="password" value="">

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" name="password_confirmation" required type="password" value="">
        </div>

        <button class="btn btn-primary btn-block" type="submit">Register</button>

    </form>
@endsection
