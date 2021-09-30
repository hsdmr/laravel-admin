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
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.page.index') }}">{{ __('main.Pages') }}</a></li>
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
                <form action="{{ route('admin.page.update', $page->id) }}" method="post" id="form">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" value="form" name="form">
                                    <input type="hidden" name="media_id" id="media_id" value="{{ $page->getMedia->id }}">
                                    <div class="form-group">
                                        <label for="title">{{ __('main.Title') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') ?? $page->title }}">
                                        @error('title') <small
                                            class="ml-auto text-danger">{{ __('main.titleError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('main.Permalink') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('slug') ?? $page->getSlug->slug }}">
                                        @error('slug') <small
                                            class="ml-auto text-danger">{{ __('main.slugError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="desc"></label>
                                        <textarea class="form-control form-control-sm" rows="3" id="content"
                                            name="content">{{ old('content') ?? $page->content }}</textarea>
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
                                            <option value="{{ $language->language }}" @if (old('language') ?? $page->language == $language->language) selected @endif>
                                                {{ $language->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    {{ __('main.Featured Image') }}
                                </div>
                                <div class="card-body">
                                    <img src="{{ $page->getMedia->id == 1 ? '' : $page->getMedia->getUrl() }}" alt=""
                                        id="media_img" class="w-100">
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
                                    {{ __('main.Page Template') }}
                                </div>
                                <div class="card-body">
                                    <select class="form-control" name="template" id="template">
                                        <option value="default" @if (old('default') ?? $page->template == 'default') selected @endif>{{ __('main.Default') }}
                                        </option>
                                        <option value="contact" @if (old('contact') ?? $page->template == 'contact') selected @endif>{{ __('main.Contact') }}
                                        </option>
                                        <option value="blog" @if (old('blog') ?? $page->template == 'blog') selected @endif>{{ __('main.Blog') }}</option>
                                        <option value="search" @if (old('search') ?? $page->template == 'search') selected @endif>{{ __('main.Search') }}</option>
                                        <option value="contract" @if (old('contract') ?? $page->template == 'contract') selected @endif>{{ __('main.Contract') }}
                                        </option>
                                        <option value="blank" @if (old('blank') ?? $page->template == 'blank') selected @endif>{{ __('main.Blank') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    {{ __('main.Sidebar') }}
                                </div>
                                <div class="card-body">
                                    <select class="form-control" name="sidebar" id="sidebar">
                                        <option value="0" @if (old('sidebar') ?? $page->sidebar == 0) selected @endif>{{ __('main.No') }}</option>
                                        <option value="1" @if (old('sidebar') ?? $page->sidebar == 1) selected @endif>{{ __('main.Page Sidebar') }}</option>
                                        <option value="2" @if (old('sidebar') ?? $page->sidebar == 2) selected @endif>{{ __('main.Blog Sidebar') }}</option>
                                    </select>
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
