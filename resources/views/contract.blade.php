@extends('layouts.master')

@section('seo_title'){{($page->getSlug->seo_title==null) ? $page->title : $page->getSlug->seo_title}}@endsection
@section('seo_description'){!!($page->getSlug->seo_description==null) ? '' : $page->getSlug->seo_title!!}@endsection
@section('no_index'){{$page->getSlug->no_index ? 'noindex' : 'index'}}@endsection
@section('no_follow'){{$page->getSlug->no_follow ? 'nofollow' : 'follow'}}@endsection
@section('image'){{$page->getMedia->getUrl()}}@endsection
@section('class')contract @endsection

@section('header')
@endsection

@section('content')
<section>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card shadow">
                    <div class="card-title text-center pt-3">
                        <h1>{{$page->title}}</h1>
                    </div>
                    <div class="card-body">
                        {!!$page->content!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
