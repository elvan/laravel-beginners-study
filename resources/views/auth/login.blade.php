@extends('layouts.app')

@section('content')
    <div class="col-6 mx-auto">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" required
                    type="email" value="">

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
                <div class="form-check">
                    <input class="form-check-input" id="remember" name="remember" type="checkbox"
                        value="{{ old('remember') ? 'checked' : '' }}">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
@endsection
