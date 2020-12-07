@extends('admin.layouts.master')

@section('title')
{{ __('Menüler') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Menüler') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Ayarlar') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Menüler') }}</li>
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
                        <form action="{{ route('admin.setting.menu.store')}}" method="post">
                            @csrf
                        <div class="card-body row">
                            <label for="menuname" class="col-md-2">Menu Adı</label>
                            <input type="text" name="menuname" id="menuname" class="form-control-sm form-control col-md-4">
                            <button class="btn btn-outline-success btn-sm ml-3">Oluştur</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection

@section('script')

@endsection
