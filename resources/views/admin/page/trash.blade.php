@extends('admin.layouts.master')

@section('title')
{{ __('Pages Recycle') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Recycle') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ __('Pages') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Recycle') }}</li>
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
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Date of Deletion') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($page->getMedia->getUrl())}} " alt="" style="width: 50px">
                                        </td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->deleted_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.page.recover',$page->id) }}" title="{{ __('Recover') }}" class="btn btn-warning btn-xs"><i class="fas fa-recycle"></i></a>
                                            <form id="delete_{{$page->id}}" action="{{route('admin.page.destroy',$page->id)}}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{$page->id}})" title="{{ __('Destroy') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
