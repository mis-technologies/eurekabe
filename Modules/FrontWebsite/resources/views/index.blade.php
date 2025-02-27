@extends('frontwebsite::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('frontwebsite.name') !!}</p>
@endsection
