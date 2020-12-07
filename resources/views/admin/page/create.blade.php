@extends('admin.layouts.master')

@section('title')
{{ __('Create Page') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Create Page') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ __('Pages') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Create Page') }}</li>
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
                                            <label for="title">{{ __('Title') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{ __('Permalink') }}</label>
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
                                                {{ __('Featured Image') }}
                                            </div>
                                            <div class="card-body">
                                                <img src="" alt="" id="media_img" class="w-100">
                                            </div>
                                            <div class="card-footer">
                                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">{{ __('Choose Image') }}</a>
                                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">{{ __('Remove Image') }}</a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Page Template') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="template" id="template">
                                                    <option value="default">{{ __('Default') }}</option>
                                                    <option value="contact">{{ __('Contact') }}</option>
                                                    <option value="blog">{{ __('Blog') }}</option>
                                                    <option value="search">{{ __('Search') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('Sidebar') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="sidebar" id="sidebar">
                                                    <option value="0">{{ __('No') }}</option>
                                                    <option value="1">{{ __('Page Sidebar') }}</option>
                                                    <option value="2">{{ __('Blog Sidebar') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('Save') }}</a>
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
