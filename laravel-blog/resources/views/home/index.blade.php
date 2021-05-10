@extends('layouts.app')

@section('content')
    <h1>{{ __('messages.welcome') }}</h1>
    <p>This is the content of the Home Page</p>

    <p>{{ __('messages.example_with_value', ['name' => 'Someuser']) }}</p>

    <p>{{ trans_choice('messages.plural', 0) }}</p>
    <p>{{ trans_choice('messages.plural', 1) }}</p>
    <p>{{ trans_choice('messages.plural', 2) }}</p>
@endsection
