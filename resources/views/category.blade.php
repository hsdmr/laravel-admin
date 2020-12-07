@extends('layouts.master')

@section('seo_title')
{{($category->getSlug->seo_title==null) ? $category->title : $category->getSlug->seo_title}}
@endsection
@section('seo_description')
{!!($category->getSlug->seo_description==null) ? '' : $page->getSlug->seo_title!!}
@endsection
@section('no_index')
{{$category->getSlug->no_index ? 'noindex' : 'index'}}
@endsection
@section('no_follow')
{{$category->getSlug->no_follow ? 'nofollow' : 'follow'}}
@endsection
@section('image')
{{$category->getMedia->getUrl()}}
@endsection
@section('class')
    category
@endsection
@section('header')

@endsection

@section('content')
<div class="title text-center">
    <h1>{{$category->title}}</h1>
</div>
<div aria-label="breadcrumb" class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{url('/blog')}}">{{ __('Blog') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
    </ol>
</div>

<section>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-9">
                @foreach ($articles as $article)
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ url('/',$article->getSlug->slug) }}"><img src="{{ $article->getMedia->getUrl('thumb')}}" alt="" class="image"></a>
                        </div>
                        <div class="col-md-9 py-2">
                            <label for="">{{$article->created_at->translatedFormat(' jS F Y ')}}</label>
                            <h5>{{$article->title}}</h5>
                            <p>{!!substr($article->content,0,150)!!} ...</p>
                            <a href="{{ url('/',$article->getSlug->slug) }}">devamı >></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                <h4>Blog Kategorileri</h4>
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
