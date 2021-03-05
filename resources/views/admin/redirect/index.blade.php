@extends('admin.layouts.master')

@section('title')
{{ __('main.Redirects') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Redirects') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Redirects') }}</li>
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
                    <a href="{{ route('admin.option.redirect.create') }}" class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('main.From') }}</th>
                                <th>{{ __('main.To') }}</th>
                                <th>{{ __('main.Type') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($redirects as $redirect)
                                <tr>
                                    <td>{{ $redirect->from }}</td>
                                    <td>{{ $redirect->to }}</td>
                                    <td>{{ $redirect->type }}</td>
                                    <td>
                                        <a href="{{ route('admin.option.redirect.edit',$redirect->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <form id="delete_{{$redirect->id}}" action="{{route('admin.option.redirect.destroy',$redirect->id)}}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <a href="javascript:void(0)" onclick="validate({{$redirect->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                        </form>
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
