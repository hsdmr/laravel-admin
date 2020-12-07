@extends('layouts.master')

@section('seo_title')
{{($article->getSlug->seo_title==null) ? $article->title : $article->getSlug->seo_title}}
@endsection
@section('seo_description')
{!!($article->getSlug->seo_description==null) ? substr($article->content,0,150).'...' : $article->getSlug->seo_title!!}
@endsection
@section('no_index')
{{$article->getSlug->no_index ? 'noindex' : 'index'}}
@endsection
@section('no_follow')
{{$article->getSlug->no_follow ? 'nofollow' : 'follow'}}
@endsection
@section('image')
{{$article->getMedia->getUrl()}}
@endsection
@section('class')
    article-{{$article->id}}
@endsection
@section('header')

@endsection

@section('content')
<div class="title text-center">
    <h1>{{$article->title}}</h1>
</div>
<div aria-label="breadcrumb" class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('main.Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{url('/blog')}}">{{ __('main.Blog') }}</a></li>
        <li class="breadcrumb-item"><a href="{{url('/',$article->getCategory->getSlug->slug)}}">{{$article->getCategory->title}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$article->title}}</li>
    </ol>
</div>

<section>
    <div class="container py-4 article">
        <div class="row">
            <div class="col-md-9">
                <div class="article">
                    @if ($article->media_id!=1)
                    <img src="{{ $article->getMedia->getUrl()}}" alt="" class="blog-big-image w-100 pb-4" style="object-fit: cover; height:20rem">
                    @endif
                    <div>{!!$article->content!!}</div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>{{ __('main.Categories') }}</h4>
                <hr>
                <ul style="font-weight: bold">
                    @foreach ($categories as $cat)
                    <li><a href="{{url('/',$cat->getSlug->slug)}}">{{$cat->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
