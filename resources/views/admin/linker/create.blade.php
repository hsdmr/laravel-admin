@extends('admin.layouts.master')

@section('title')
    {{ __('main.Add New Link') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.Add New Link') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.option.link.index') }}">{{ __('main.Auto Linkers') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.Add New Link') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.option.link.store') }}" method="post" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="word" class="col-md-3">{{ __('main.Word') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm col-md-9 @error('word') is-invalid @enderror"
                                            id="word" name="word" value="{{ old('word') }}">
                                        @error('word') <small
                                            class="ml-auto text-danger">{{ __('main.wordError') }}</small> @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="url" class="col-md-3">{{ __('main.Url') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm col-md-9 @error('url') is-invalid @enderror"
                                            id="url" name="url" value="{{ old('url') }}">
                                        @error('url') <small
                                            class="ml-auto text-danger">{{ __('main.urlError') }}</small> @enderror
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
@endsection

@section('script')

@endsection
