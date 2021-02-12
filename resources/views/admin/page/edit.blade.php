@extends('admin.layouts.master')

@section('title')
{{ __('main.Edit Page') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Edit Page') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ __('main.Pages') }}</a></li>
              <li class="breadcrumb-item active">{{ $page->title }}</li>
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
                        <form action="{{ route('admin.page.update',$page->id) }}" method="post" id="form">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="hidden" value="form" name="form">
                                        <input type="hidden" name="media_id" id="media_id" value="{{$page->getMedia->id}}">
                                        <div class="form-group">
                                            <label for="title">{{ __('main.Title') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$page->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{ __('main.Permalink') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{$page->getSlug->slug}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc"></label>
                                            <textarea class="form-control form-control-sm" rows="3" id="content" name="content">{{$page->content}}</textarea>
                                        </div>
                                        @include('admin.layouts.slug')
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('main.Featured Image') }}
                                            </div>
                                            <div class="card-body">
                                                <img src="{{ ($page->getMedia->id==1) ? '' : $page->getMedia->getUrl()}}" alt="" id="media_img" class="w-100">
                                            </div>
                                            <div class="card-footer">
                                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">{{ __('main.Choose Image') }}</a>
                                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">{{ __('main.Remove Image') }}</a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('main.Page Template') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="template" id="template">
                                                    <option value="default" @if ($page->template=='default') selected @endif>{{ __('main.Default') }}</option>
                                                    <option value="contact" @if ($page->template=='contact') selected @endif>{{ __('main.Contact') }}</option>
                                                    <option value="blog" @if ($page->template=='blog') selected @endif>{{ __('main.Blog') }}</option>
                                                    <option value="search" @if ($page->template=='search') selected @endif>{{ __('main.Search') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __('main.Sidebar') }}
                                            </div>
                                            <div class="card-body">
                                                <select class="form-control" name="sidebar" id="sidebar">
                                                    <option value="0" @if ($page->sidebar==0) selected @endif>{{ __('main.No') }}</option>
                                                    <option value="1" @if ($page->sidebar==1) selected @endif>{{ __('main.Page Sidebar') }}</option>
                                                    <option value="2" @if ($page->sidebar==2) selected @endif>{{ __('main.Blog Sidebar') }}</option>
                                                </select>
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
