@extends('admin.layouts.master')

@section('title')
{{ __('Sayfa Düzenle') }}
@endsection

@section('header')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('admin')}}/plugins/summernote/summernote-bs4.css">
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Sayfa Düzenle') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ __('Sayfalar') }}</a></li>
              <li class="breadcrumb-item active">{{ $page->title }}</li>
            </ol>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.page.update',$page->id) }}" method="post" id="form">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="hidden" value="form" name="form">
                                        <input type="hidden" name="media_id" id="media_id" value="{{$page->getMedia->id}}">
                                        <div class="form-group">
                                            <label for="title">Başlık</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$page->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Kısa Ad</label>
                                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{$page->getSlug->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc"></label>
                                            <textarea class="form-control form-control-sm" rows="3" id="content" name="content">{{$page->content}}</textarea>
                                        </div>
                                        @include('admin.layouts.slug')
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Öne Çıkan Görsel') }}
                                            </div>
                                            <div class="card-body">
                                                <img src="{{ ($page->getMedia->id==1) ? '' : $page->getMedia->getUrl()}}" alt="" id="media_img" class="w-100">
                                            </div>
                                            <div class="card-footer">
                                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">Görsel Seç</a>
                                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">Görseli Kaldır</a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Sayfa Yapısı') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="template" id="template">
                                                    <option value="standart" @if ($page->template=='standart') selected @endif>Standart</option>
                                                    <option value="iletisim" @if ($page->template=='iletisim') selected @endif>İletişim</option>
                                                    <option value="blog" @if ($page->template=='blog') selected @endif>Blog</option>
                                                    <option value="doktorlar" @if ($page->template=='doktorlar') selected @endif>Doktorlar</option>
                                                    <option value="listele" @if ($page->template=='listele') selected @endif>Arama Sayfası</option>
                                                    <option value="uzmanlik-alanlari" @if ($page->template=='uzmanlik-alanlari') selected @endif>Uzmanlık Alanları</option>
                                                    <option value="hastaliklar" @if ($page->template=='hastaliklar') selected @endif>Hastalıklar</option>
                                                    <option value="hizmetler-tedaviler" @if ($page->template=='hizmetler-tedaviler') selected @endif>Hizmetler-Tedaviler</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Sidebar') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="sidebar" id="sidebar">
                                                    <option value="0" @if ($page->sidebar==0) selected @endif>Hayır</option>
                                                    <option value="1" @if ($page->sidebar==1) selected @endif>Sayfa Sidebar</option>
                                                    <option value="2" @if ($page->sidebar==2) selected @endif>Blog Sidebar</option>
                                                    <option value="3" @if ($page->sidebar==3) selected @endif>Sidebar 1</option>
                                                    <option value="4" @if ($page->sidebar==4) selected @endif>Sidebar 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">Kaydet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@include('admin.layouts.media')
@endsection

@section('script')
<!-- Summernote -->
<script src="{{asset('admin')}}/plugins/summernote/summernote-bs4.min.js"></script>

@endsection
