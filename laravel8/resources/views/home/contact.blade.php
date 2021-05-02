@extends('layouts.app')

@section('content')
    <h1>Contact Page</h1>
    <p>Please feel free to contact us, our customer service center is working for you 24/7.</p>

    @can('home.secret')
        <a href="{{ route('home.secret') }}">
            Special contact details
        </a>
    @endcan
@endsection
