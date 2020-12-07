@extends('admin.layouts.master')

@section('title')
{{ __('Users Add') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Users Add') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ __('Users') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Users Add') }}</li>
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
                        <form action="{{ route('admin.user.store') }}" method="post" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="title">{{ __('E-mail') }}</label>
                                                    <input type="text" class="form-control form-control-sm" id="title" name="email" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">{{ __('Phone') }}</label>
                                                    <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">{{ __('Surname') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="surname" name="surname" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">{{ __('Role') }}</label>
                                            <select name="role" id="role" class="form-control form-control-sm">
                                                <option value="user">{{ __('User') }}</option>
                                                <option value="admin">{{ __('Admin') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input type="text" class="form-control form-control-sm" id="password" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">

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

@endsection

@section('script')

@endsection
