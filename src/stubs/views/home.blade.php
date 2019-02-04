@extends('layouts/base')

@section('title', 'Home')
@section('navbar', true)

@section('body')
    <div class="flex-1 justify-center bg-grey-lightest pt-6">
        <example-component title="Dashboard">
            You are signed in!
        </example-component>
    </div>
@endsection
