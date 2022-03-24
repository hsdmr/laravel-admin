@extends('layouts.master')

@section('seo_title'){{($page->getSlug->seo_title==null) ? $page->title : $page->getSlug->seo_title}}@endsection
@section('seo_description'){!!($page->getSlug->seo_description==null) ? '' : $page->getSlug->seo_title!!}@endsection
@section('no_index'){{$page->getSlug->no_index ? 'noindex' : 'index'}}@endsection
@section('no_follow'){{$page->getSlug->no_follow ? 'nofollow' : 'follow'}}@endsection
@section('image'){{$page->getMedia->getUrl() ?? ''}}@endsection
@section('class')blank @endsection

@section('header')
<style>
    .all{
        margin-top: 0px !important;
    }
</style>
@endsection

@section('content')
<section>
    {!!$page->content!!}
</section>
@endsection

@section('script')

@endsection
