@extends('admin.layouts.master')

@section('title')
{{ __('main.Add New Redirect') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Add New Redirect') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.option.redirect.index') }}">{{ __('main.Redirects') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Add New Redirect') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.option.redirect.store') }}" method="post" id="form">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="from" class="col-md-3">{{ __('main.From') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" id="from" name="from">
                                </div>
                                <div class="form-group row">
                                    <label for="to" class="col-md-3">{{ __('main.To') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" id="to" name="to">
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-md-3">{{ __('main.Type') }}</label>
                                    <select class="form-control form-control-sm col-md-9" name="type" id="type">
                                        <option value="302">{{ __('main.Temporary') }}</option>
                                        <option value="301">{{ __('main.Permanent') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="save-card">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('main.Save') }}</a>
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
