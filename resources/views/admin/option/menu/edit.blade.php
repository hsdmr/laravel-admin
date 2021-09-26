@extends('admin.layouts.master')

@section('title')
    {{ __('main.Menus') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ $menus[0]->menuname }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.option.menu.index') }}">{{ __('main.Menus') }}</a></li>
                            <li class="breadcrumb-item active">{{ $menus[0]->menuname }}</li>
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
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="page">{{ __('main.Pages') }}</label>
                                    <select name="page" id="page" class="form-control">
                                        <option value="">{{ __('main.Choose') }}</option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->getSlug->slug }}">{{ $page->title }}</option>
                                        @endforeach
                                        <option value="login">{{ __('main.Login') }}</option>
                                        <option value="register">{{ __('main.Register') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">{{ __('main.Categories') }}</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">{{ __('main.Choose') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->getSlug->slug }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="article">{{ __('main.Posts') }}</label>
                                    <select name="article" id="article" class="form-control">
                                        <option value="">{{ __('main.Choose') }}</option>
                                        @foreach ($articles as $article)
                                            <option value="{{ $article->getSlug->slug }}">{{ $article->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <b class="text-danger">{{ __('main.Reminders') }}</b>
                                <ul style="padding-left:20px">
                                    <li class="mb-2">{{ __('main.Click side to select menu icon.') }} <a
                                            href="https://fontawesome.com/icons?d=gallery&m=free">{{ __('main.here') }}</a>
                                    </li>
                                    <li class="mb-2">
                                        {{ __('main.Use the "Order" field to sort the menu items.') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.option.menu.update', $menu->id) }}" method="post" id="form">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="position" id="position" value="{{ $menu->position }}">
                                    <input type="hidden" name="menuname" id="menuname" value="{{ $menu->menuname }}">
                                    <div class="form-group">
                                        <label for="title">{{ __('main.Title') }}</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') ?? $menu->title }}">
                                        @error('title') <small
                                            class="ml-auto text-danger">{{ __('main.titleError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="icon">{{ __('main.Icon') }}</label>
                                        <input type="text" name="icon" id="icon"
                                            class="form-control @error('icon') is-invalid @enderror"
                                            value="{{ old('icon') ?? $menu->icon }}">
                                        @error('icon') <small
                                            class="ml-auto text-danger">{{ __('main.iconError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="link">{{ __('main.Link') }}</label>
                                        <input type="text" name="link" id="link"
                                            class="form-control @error('link') is-invalid @enderror"
                                            value="{{ old('link') ?? $menu->link }}">
                                        @error('link') <small
                                            class="ml-auto text-danger">{{ __('main.linkError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parent">{{ __('main.Parent') }}</label>
                                        <select name="parent" id="parent"
                                            class="form-control @error('parent') is-invalid @enderror">
                                            <option value=""></option>
                                            @foreach ($menus as $mnu)
                                                @if ($mnu->title != null)
                                                    <option value="{{ $mnu->id }}" @if (old('parent') ?? $mnu->id == $menu->parent) selected @endif>
                                                        {{ $mnu->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent') <small
                                            class="ml-auto text-danger">{{ __('main.parentError') }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="order">{{ __('main.Order') }}</label>
                                        <input type="number" name="order" id="order"
                                            class="form-control @error('order') is-invalid @enderror"
                                            value="{{ old('order') ?? $menu->order }}">
                                        @error('order') <small
                                            class="ml-auto text-danger">{{ __('main.orderError') }}</small> @enderror
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                                    id="submit">{{ __('main.Save') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">{{ __('main.Order') }}</th>
                                            <th>{{ __('main.Title') }}</th>
                                            <th>{{ __('main.Link') }}</th>
                                            <th style="width: 40px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            menuOrder($menus);
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $("#page").change(function() {
            var title = "";
            var link = "";
            $("#page option:selected").each(function() {
                title = $(this).text();
                link = $(this).val();
            });
            $("#title").val(title);
            $("#link").val(link);
        });
        $("#article").change(function() {
            var title = "";
            var link = "";
            $("#article option:selected").each(function() {
                title = $(this).text();
                link = $(this).val();
            });
            $("#title").val(title);
            $("#link").val(link);
        });
        $("#category").change(function() {
            var title = "";
            var link = "";
            $("#category option:selected").each(function() {
                title = $(this).text();
                link = $(this).val();
            });
            $("#title").val(title);
            $("#link").val(link);
        });
    </script>
@endsection
