@extends('admin.layouts.master')

@section('title')
{{ __('main.Edit Slide') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Edit Slide') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.slide.index') }}">{{ __('main.Slides') }}</a></li>
              <li class="breadcrumb-item active"></li>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">

                </div>
                <div class="col-md-1"></div>
            </div>
            <form action="{{ route('admin.slide.update',$slide->id) }}" method="post" id="form">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bc">Arkaplan</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm" id="bc" name="bc" value="">
                                        <span class="input-group-append">
                                          <button type="button" class="btn btn-info btn-flat">Seç</button>
                                        </span>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" class="" id="image" name="is_video" @if($slide->is_video==1) checked @endif>
                                    <label for="image">İmage</label>
                                    <input type="radio" class="ml-5" id="video" name="is_video" @if($slide->is_video==0) checked @endif>
                                    <label for="video">Video</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="color">Renk</label>
                                            <input type="color" class="form-control form-control-sm" id="color" name="color" value="{{$slide->color}}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="range">Saydamlık</label>
                                            <input type="range" class="form-control form-control-sm" id="range" name="range" value="{{$slide->opacity}}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="order">Sıra</label>
                                            <input type="text" class="form-control form-control-sm" id="order" name="order" value="{{$slide->order}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="language">Dil</label>
                                    <select class="form-control form-control-sm" id="language" name="language">
                                        <option value="tr" @if($slide->language=='tr') selected @endif>Türkçe</option>
                                        <option value="en" @if($slide->language=='en') selected @endif>English</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control form-control-sm" id="link" name="link" value="{{$slide->link}}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Başlık</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$slide->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="content">İçerik</label>
                                    <input type="text" class="form-control form-control-sm" id="" name="content" value="{{$slide->content}}">
                                </div>
                                <div class="form-group">
                                    <label for="button">Button</label>
                                    <input type="text" class="form-control form-control-sm" id="button" name="button" value="{{$slide->button}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card" id="save-card">
                <div class="card-body">
                    <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('main.Update') }}</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection

@section('script')

@endsection
