@extends('admin.layouts.master')

@section('title')
    {{ __('main.Edit Category') }}
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.Edit Category') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.category.index') }}">{{ __('main.Categories') }}</a></li>
                            <li class="breadcrumb-item active">{{ $category->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.category.update', $category->id) }}" method="post" id="form">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="media_id" id="media_id"
                        value="{{ old('media_id') ?? $category->getMedia->id }}">
                    <input type="hidden" name="type" value="article-category">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group ">
                                        <label for="title">{{ __('main.Name') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') ?? $category->title }}">
                                        @error('title') <small
                                            class="ml-auto text-danger">{{ __('main.titleError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('main.Permalink') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('title') ?? $category->getSlug->slug }}">
                                        @error('slug') <small
                                            class="ml-auto text-danger">{{ __('main.slugError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">{{ __('main.Description') }}</label>
                                        <textarea class="form-control form-control-sm" rows="3" id="content"
                                            name="content">{{ old('title') ?? $category->content }}</textarea>
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
                                            <option value="{{ $language->language }}" @if (old('title') ?? $category->language == $language->language) selected @endif>
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
                                    <img src="{{ $category->getMedia->id == 1 ? '' : $category->getMedia->getUrl() ?? '' }}"
                                        alt="" id="media_img" class="w-100">
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
                                    <label for="upper">{{ __('main.Parent') }}</label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="upper" name="upper">
                                            <option value="0"></option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" @if (old('title') ?? $category->upper == $cat->id) {{ 'selected' }} @endif>
                                                    {{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="save-card">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                                    id="submit">{{ __('main.Update') }}</a>
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
