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
                        <h4 class="m-0 text-dark">{{ __('main.Menus') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.Menus') }}</li>
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
                <div class="card">
                    <form action="{{ route('admin.option.menu.menuName') }}" method="post">
                        @csrf
                        <div class="card-body row">
                            <label for="menuname" class="col-md-2">{{ __('main.Menu Name') }}</label>
                            <input type="text" name="menuname" id="menuname"
                                class="form-control-sm form-control col-md-4 @error('menuname') is-invalid @enderror">
                            <button class="btn btn-outline-success btn-sm ml-3">{{ __('main.Create') }}</button>
                            <div class="col-md-3"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                @error('menuname') <small
                                    class="ml-auto text-danger">{{ __('main.menuNameError') }}</small> @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
@endsection

@section('script')

@endsection
