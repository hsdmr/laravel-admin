@extends('admin.layouts.master')

@section('title')
{{ __('Sayfa Oluştur') }}
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
            <h4 class="m-0 text-dark">{{ __('Sayfa Oluştur') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ __('Sayfalar') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Sayfa Oluştur') }}</li>
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
                        <form action="{{ route('admin.page.store') }}" method="post" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="hidden" value="form" name="form">
                                        <input type="hidden" name="media_id" id="media_id" value="">
                                        <div class="form-group">
                                            <label for="title">Başlık</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Kısa Ad</label>
                                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc"></label>
                                            <textarea class="form-control form-control-sm" rows="3" id="content" name="content"></textarea>
                                        </div>
                                        @include('admin.layouts.slug')
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Öne Çıkan Görsel') }}
                                            </div>
                                            <div class="card-body">
                                                <img src="" alt="" id="media_img" class="w-100">
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
                                                    <option value="standart">Standart</option>
                                                    <option value="iletisim">İletişim</option>
                                                    <option value="blog">Blog</option>
                                                    <option value="doktorlar">Doktorlar</option>
                                                    <option value="listele">Arama Sayfası</option>
                                                    <option value="uzmanlik-alanlari">Uzmanlık Alanları</option>
                                                    <option value="hastaliklar">Hastalıklar</option>
                                                    <option value="hizmetler-tedaviler">Hizmetler-Tedaviler</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Sidebar') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="sidebar" id="sidebar">
                                                    <option value="0">Hayır</option>
                                                    <option value="1">Sayfa Sidebar</option>
                                                    <option value="2">Blog Sidebar</option>
                                                    <option value="3">Sidebar 1</option>
                                                    <option value="4">Sidebar 2</option>
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
