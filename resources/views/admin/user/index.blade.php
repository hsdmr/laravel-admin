@extends('admin.layouts.master')

@section('title')
{{ __('main.Users') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Users') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Users') }}</li>
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
                <div class="card-header">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                    <a href="{{ route('admin.user.trash') }}" class="btn btn-warning btn-sm float-right"><i class="fas fa-trash-alt"></i>{{ __('main.Recycle') }}</a>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('main.Name') }}</th>
                                <th>{{ __('main.E-mail') }}</th>
                                <th>{{ __('main.Role') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit',$user->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('admin.user.delete',$user->id) }}" onclick="validate({{$user->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>

@endsection

@section('script')

@endsection
