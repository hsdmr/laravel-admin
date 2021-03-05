<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('seo_title')</title>
    <meta name="description" CONTENT="@yield('seo_description')">
    <meta name="robots" content="@if($option['no_index']==1)noindex @else @yield('no_index')@endif,@if($option['no_follow']==1)nofollow @else @yield('no_follow')@endif">
    <meta name="googlebot" content="@if($option['no_index']==1)noindex @else @yield('no_index')@endif,@if($option['no_follow']==1)nofollow @else @yield('no_follow')@endif" />
    <link rel="icon" sizes="48x48" href="{{App\Models\File::find($option['favicon'])->getMedia()->first()->getUrl('thumb')}}" type="image/x-icon" />
    <!-- Social: Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_title')">
    <meta name="twitter:description" content="@yield('seo_description')">
    <meta name="twitter:image:src" content="@yield('image')">
    <!-- Social: Facebook / Open Graph -->
    <meta property="og:url" content="{{Request::fullUrl()}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('seo_title')">
    <meta property="og:image" content="@yield('image')"/>
    <meta property="og:description" content="@yield('seo_description')">
    <meta property="og:site_name" content="Süper Doktorlar">
    @include('layouts.header')
    @yield('header')
    <style>
        {!! $option['headcss'] !!}
    </style>
    {!! $option['headjs'] !!}
</head>
<body class="@yield('class')">

    @include('layouts.menu')
    <div class="all" style="margin-top: 90px">
        @yield('content')
    </div>

    @include('layouts.footer')

    @yield('script')
    {!! $option['footerjs'] !!}
</body>
</html>
