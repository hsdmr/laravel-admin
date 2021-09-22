@extends('admin.layouts.master')

@section('title')
    {{ __('main.Add New Post') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.Add New Post') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.article.index') }}">{{ __('main.Posts') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.Add New Post') }}</li>
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
                <form action="{{ route('admin.article.store') }}" method="post" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="media_id" id="media_id" value="{{ old('media_id') }}">
                                    <input type="hidden" id="category_id" name="category_id"
                                        value="{{ old('category_id') }}">
                                    <div class="form-group">
                                        <label for="title">{{ __('main.Title') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('Title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') }}">
                                        @error('title') <small class="ml-auto text-danger">{{ __('main.titleError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('main.Permalink') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('slug') }}">
                                            @error('slug') <small class="ml-auto text-danger">{{ __('main.slugError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm" rows="3" id="content"
                                            name="content">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @include('admin.layouts.slug')
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <label for="language">{{ __('main.Language') }}</label>
                                </div>
                                <div class="card-body">
                                    <select name="language" id="language" class="form-control form-control-sm">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->language }}" @if (old('language') == $language->language) selected @endif>
                                                {{ $language->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <label for="media_img">{{ __('main.Featured Image') }}</label>
                                </div>
                                <div class="card-body">
                                    <img src="" alt="" id="media_img" class="w-100">
                                </div>
                                <div class="card-footer">
                                    <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left"
                                        id="choose">{{ __('main.Choose Image') }}</a>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right"
                                        id="remove">{{ __('main.Remove Image') }}</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <label>{{ __('main.Category') }}</label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="category" name="category">
                                            <option value="0"></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="save-card">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                                    id="submit">{{ __('main.Save') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>

    @include('admin.layouts.media')
@endsection

@section('script')

@endsection
