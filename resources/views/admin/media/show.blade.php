@extends('admin.layouts.master')

@section('title')
    {{ $media->name }}
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
            <h4 class="m-0 text-dark">{{ $media->name }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.media.index') }}">{{ __('Media') }}</a></li>
                <li class="breadcrumb-item active">{{ $media->name }}</li>
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
                        <div class="card-header">
                            <a href="{{ route('admin.media.index') }}" class="btn btn-danger float-right btn-sm"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="card-body">
                            @php
                                $id = $media->id;
                                $media = $media->getMedia();
                            @endphp
                            <div class="row">
                                <div class="col-md-8 text-center">
                                    <img class="border" style="max-width: 100%; background-color: whitesmoke" src="{{ $media[0]->getUrl() }}" alt="">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>İsim</label>
                                        <input type="text" class="form-control form-control-sm" disabled="" value="{{ $media[0]->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alt Etiketi</label>
                                        <input type="text" class="form-control form-control-sm" disabled="" value="{{ $media[0]->alt }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="text" class="form-control form-control-sm" disabled="" value="{{ $media[0]->getUrl() }}">
                                    </div>
                                    <form action="{{route('admin.media.destroy',$id)}}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" title="Sil" class="btn btn-danger btn-xs float-right ml-2">Sil</button>
                                    </form>
                                    <a href="{{ route('admin.media.edit',$id) }}" class="btn btn-primary btn-xs float-right ml-2">Düzenle</a>
                                </div>
                            </div>
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
