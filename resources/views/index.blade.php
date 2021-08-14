@extends('layouts.master')

@section('seo_title'){{($page->getSlug->seo_title==null) ? '' : $page->getSlug->seo_title}}@endsection
@section('seo_description'){!!($page->getSlug->seo_description==null) ? '' : $page->getSlug->seo_description!!}@endsection
@section('no_index'){{$page->getSlug->no_index ? 'noindex' : 'index'}}@endsection
@section('no_follow'){{$page->getSlug->no_follow ? 'nofollow' : 'follow'}}@endsection
@section('image'){{ $page->getMedia->getUrl() }}@endsection
@section('class')home @endsection
@section('header')

@endsection

@section('content')
    <div class="container text-center">
        <h1 class="mt-5 pt-5">{{ __('main.Hello') }}</h1>
        <p>{{ __('main.Laravel and AdminLTE') }}</p>
        <a href="https://github.com/hsdmr/laravel-admin">{{ __('main.Installation') }}</a>
    </div>
@endsection

@section('script')

@endsection
