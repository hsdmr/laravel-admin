@extends('admin.layouts.master')

@section('title')
{{ __('Comments Recycle') }}
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
                <li class="breadcrumb-item"><a href="{{ route('admin.comment.index') }}">{{ __('Comments') }}</a></li>
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
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th>{{ __('Deletion Date') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->getUser->name }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->deleted_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.comment.recover',$comment->id) }}" title="{{ __('Recover') }}" class="btn btn-warning btn-xs"><i class="fas fa-recycle"></i></a>
                                            <form id="delete_{{$comment->id}}" action="{{route('admin.comment.destroy',$comment->id)}}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{$comment->id}})" title="{{ __('Destroy') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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
