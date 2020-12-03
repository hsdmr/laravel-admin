@extends('admin.layouts.master')

@section('title')
    Yeni Kategori Ekle
@endsection

@section('header')

@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Yeni Kategori Ekle') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ __('Kategori') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Yeni Kategori Ekle') }}</li>
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
                        <form action="{{ route('admin.category.store') }}" method="post" id="form">
                            @csrf
                            <input type="hidden" value="form" name="form">
                            <input type="hidden" name="media_id" id="media_id" value="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="title">İsim</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Kısa Ad</label>
                                            <input type="text" class="form-control form-control-sm" id="slug" name="slug">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Açıklama</label>
                                            <textarea class="form-control form-control-sm" rows="3" id="content" name="content"></textarea>
                                        </div>
                                        @include('admin.layouts.slug')
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="media_img">{{ __('Öne Çıkan Görsel') }}</label>
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
                                                <label for="upper">{{ __('Ebeveyn Kategori') }}</label>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" id="upper" name="upper">
                                                        <option value="0"></option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">Yeni Kategori Ekle</a>
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

@endsection
