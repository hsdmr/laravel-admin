@extends('layouts.master')

@section('seo_title')

@endsection
@section('seo_description')

@endsection
@section('no_index')

@endsection
@section('no_follow')

@endsection
@section('image')

@endsection

@section('class')
home
@endsection

@section('header')

@endsection

@section('content')
<div class="container text-center">
    <h1 class="mt-5 pt-5">{{ __('Hello') }}</h1>
    <p>{{ __('Laravel and AdminLTE ') }}</p>
    <a href="https://github.com/hsdmr/laravel-admin">{{ __('Installation') }}</a>
</div>
@endsection

@section('script')

@endsection
