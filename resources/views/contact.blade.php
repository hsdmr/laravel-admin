@extends('layouts.master')

@section('seo_title'){{ $page->getSlug->seo_title == null ? $page->title : $page->getSlug->seo_title }}@endsection
@section('seo_description'){!! $page->getSlug->seo_description == null ? '' : $page->getSlug->seo_title !!}@endsection
@section('no_index'){{ $page->getSlug->no_index ? 'noindex' : 'index' }}@endsection
@section('no_follow'){{ $page->getSlug->no_follow ? 'nofollow' : 'follow' }}@endsection
@section('image'){{ $page->getMedia->getUrl() }}@endsection
@section('class')content @endsection
@section('header')

@endsection

@section('content')
    <div class="title text-center">
        <h1>{{ __('main.Contact') }}</h1>
    </div>
    <div aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('main.Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('main.Contact') }}</li>
        </ol>
    </div>

    <section>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ __('main.Contact Information') }}</h2>
                    @if ($page->content != null)
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    @else
                        <p>@isset($contact['address']){{ $contact['address'] }}@endisset</p>
                        <p><b>{{ __('main.Call center') }}:</b>@isset($contact['phone']){{ $contact['phone'] }}@endisset</p>
                        <p><b>{{ __('main.Phone') }}:</b>@isset($contact['cell']){{ $contact['cell'] }}@endisset</p>
                        <p><b>{{ __('main.E-mail') }}:</b>@isset($contact['email']){{ $contact['email'] }}@endisset</p>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <h2>{{ __('main.Contact Form') }}</h2>
                    <form action="">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <input type="text" placeholder="{{ __('main.Name') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{{ __('main.Surname') }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <input type="text" placeholder="{{ __('main.E-mail') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{{ __('main.Phone') }}" class="form-control">
                            </div>
                        </div>
                        <textarea name="" id="" cols="30" rows="10" placeholder="{{ __('main.Message') }}"
                            class="form-control mb-4"></textarea>
                        <button type="submit" class="btn btn-success"><b>{{ __('main.Submit') }}</b></button>
                    </form>
                </div>
                <iframe style="width: 100%; height:500px;" id="gmap_canvas"
                    src="https://maps.google.com/maps?q={{ isset($contact['map']) ? $contact['map'] : 'Ayasofya' }}&t=&z={{ isset($contact['zoom']) ? $contact['zoom'] : '13' }}&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
