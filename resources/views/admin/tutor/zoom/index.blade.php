@extends('admin.layouts.master')

@section('title')
{{ __('main.Zoom Meetings') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Zoom Meetings') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tutor.zoom.index') }}">{{ __('main.ZOOM') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Zoom Meetings') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @foreach ($zooms as $zoom)
            @php
                $zoom = unserialize($zoom->zoom);
            @endphp
            <div class="card">

            </div>
            @endforeach
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@include('admin.tutor.course.topic')
@endsection

@section('script')
<script>
function topicModalOpen(e){
    console.log(e.dataset.topic);
    $('#courseIdModal').val(e.dataset.course);
    $('#topicIdModal').val(e.dataset.topic);
    $('#topic-modal').modal('show');
}
</script>
@endsection
