@extends('layouts.master')

@section('seo_title'){{($page->getSlug->seo_title==null) ? $page->title : $page->getSlug->seo_title}}@endsection
@section('seo_description'){!!($page->getSlug->seo_description==null) ? '' : $page->getSlug->seo_title!!}@endsection
@section('no_index'){{$page->getSlug->no_index ? 'noindex' : 'index'}}@endsection
@section('no_follow'){{$page->getSlug->no_follow ? 'nofollow' : 'follow'}}@endsection
@section('image'){{$page->getMedia->getUrl()}}@endsection
@section('class')blog @endsection
@section('header')

@endsection

@section('content')
<div class="title text-center">
    <h1>{{ __('main.Blog') }}</h1>
</div>
<div aria-label="breadcrumb" class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('main.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('main.Blog') }}</li>
    </ol>
</div>
<section>
    <div class="container py-4 article">
        <div class="row">
            <div class="col-md-9">
                @foreach ($articles as $article)
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            @if ($article->getMedia->id!=1)
                            <a href="{{ url('/',$article->getSlug->slug) }}"><img src="{{ $article->getMedia->getUrl('thumb')}}" alt="" class="image"></a>
                            @endif
                        </div>
                        <div class="col-md-9 py-2">
                            <label for="">{{$article->created_at->translatedFormat(' jS F Y ')}}</label>
                            <h5>{{$article->title}}</h5>
                            <p>{!!substr($article->content,0,150)!!} ...</p>
                            <a href="{{ url('/',$article->getSlug->slug) }}">{{ __('main.more') }} >></a>
                        </div>
                    </div>
                </div>
                @endforeach
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
