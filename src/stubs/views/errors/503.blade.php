@extends('layouts/base')

@section('title', '503 Service Unavailable')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center text-center">
        <div class="font-semibold text-3xl text-grey-darkest">503</div>

        <div class="my-6 w-16 h-1 block bg-grey-darkest"></div>

        <div class="text-lg text-grey-darker">{{ $exception->getMessage() ?: 'We\'ll be right back.' }}</div>
    </div>
@endsection
