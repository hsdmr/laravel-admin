@extends('admin.layouts.master')

@section('title')
{{ __('Yorum Düzenle') }}
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
            <h4 class="m-0 text-dark">{{ __('Yorum Düzenle') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.comment.index') }}">{{ __('Yorumlar') }}</a></li>
              <li class="breadcrumb-item active">{{ $comment->title }}</li>
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
                        <form action="{{ route('admin.comment.update',$comment->id) }}" method="post" id="form">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Başlık</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$comment->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc"></label>
                                            <textarea class="form-control form-control-sm" rows="3" id="content" name="content">{{$comment->content}}</textarea>
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
@endsection

@section('script')

@endsection
