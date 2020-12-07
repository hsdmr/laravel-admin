@extends('layouts.master')

@section('seo_title')
{{($page->getSlug->seo_title==null) ? $page->title.' | Süper Doktorlar' : $page->getSlug->seo_title}}
@endsection
@section('seo_description')
{!!($page->getSlug->seo_description==null) ? 'Süper Doktorlar İletişim bilgileri: Küçükbakkalköy mah. Merdivenköy Yolu cad. No:12 Kat:2 CZD Plaza 34750 Ataşehir / İSTANBUL, Çağrı Merkezi: 0 (850) 433 93 93' : $page->getSlug->seo_title!!}
@endsection
@section('no_index')
{{$page->getSlug->no_index ? 'noindex' : 'index'}}
@endsection
@section('no_follow')
{{$page->getSlug->no_follow ? 'nofollow' : 'follow'}}
@endsection
@section('image')
{{$page->getMedia->getUrl()}}
@endsection
@section('class')
    content
@endsection
@section('header')

@endsection

@section('content')
<div class="title text-center">
    <h1>{{ __('Contact') }}</h1>
</div>
<div aria-label="breadcrumb" class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Contact') }}</li>
    </ol>
</div>

<section>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ __('Contact Information') }}</h2>
                @if ($page->content!=null)
                    <div class="page-content">
                        {!!$page->content!!}
                    </div>
                @else
                <p>{!!$contact->address!!}</p>
                <p><b>{{ __('Call center') }}:</b>{!!$contact->phone!!}</p>
                <p><b>{{ __('Phone') }}:</b>{!!$contact->cell!!}</p>
                <p><b>{{ __('E-mail') }}:</b>{!!$contact->email!!}</p>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <h2>{{ __('Contact Form') }}</h2>
                <form action="">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="text" placeholder="İsim" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Soyisim" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Telefon" class="form-control">
                        </div>
                    </div>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Mesajınız" class="form-control mb-4"></textarea>
                    <button type="submit" class="btn btn-success"><b>{{ __('Submit') }}</b></button>
                </form>
            </div>
            <iframe style="width: 100%; height:500px;" id="gmap_canvas" src="https://maps.google.com/maps?q={{$contact->map}}&t=&z={{$contact->zoom}}&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
