@extends('admin.layouts.master')

@section('title')
{{ __('Medya') }}
@endsection

@section('header')
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/ekko-lightbox/ekko-lightbox.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Medya') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('Anasayfa') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Medya') }}</li>
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
                        <div class="card-body">
                            <div class="infinite-scroll">
                                <div class="scroll-content">
                                @foreach ($medias as $media)
                                @php
                                    $id = $media->id;
                                    $media = $media->getMedia('default')->first();
                                @endphp
                                    @if ($id!=1)
                                    <div class="thumbnail">
                                        <a href="{{ route('admin.media.show',$id) }}">
                                            <img id="{{ $id }}" src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                                {{ $medias->links() }}
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
