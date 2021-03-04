@extends('admin.layouts.master')

@section('title')
    {{ $media->name }}
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
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.media.index') }}">{{ __('main.Media') }}</a></li>
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
                                $media = $media->getMedia()
                            @endphp
                            <div class="row">
                                <div class="col-md-8 text-center">
                                    <img class="border" style="max-width: 100%; background-color: whitesmoke" src="{{ $media[0]->getUrl() }}" alt="">
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('admin.media.update',$id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">{{ __('main.Name') }}</label>
                                            <input type="text" class="form-control form-control-sm" value="{{ $media[0]->name }}" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="alt">{{ __('main.Alt Tag') }}</label>
                                            <input type="text" class="form-control form-control-sm"  value="{{ $media[0]->alt }}" id="alt" name="alt">
                                        </div>
                                        <div class="form-group">
                                            <label for="url">{{ __('main.Url') }}</label>
                                            <input type="text" class="form-control form-control-sm" disabled="" value="{{ $media[0]->getUrl() }}" id="url" name="url">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-xs float-right">{{ __('main.Update') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>

@endsection

@section('script')

@endsection
