@extends('messaging::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('messaging.name') !!}</p>
@endsection
