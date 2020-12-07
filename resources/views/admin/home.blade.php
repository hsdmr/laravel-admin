@extends('admin.layouts.master')

@section('title')
{{ __('main.Dashboard') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h1 class="text-danger text-center mt-5">{{ __('main.Welcome') }}</h1>
      </div>
    </div>
  </div>

@endsection

@section('script')

@endsection
