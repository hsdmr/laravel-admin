@extends('admin.layouts.master')

@section('title')
{{ __('Comments') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Comments') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Comments') }}</li>
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
                    <div class="card-header">
                        <a href="{{ route('admin.comment.trash') }}" class="btn btn-warning btn-sm float-right"><i class="fas fa-trash-alt"></i>{{ __('Recylce') }}</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th>{{ __('Post') }}</th>
                                    <th>{{ __('Creaton Date') }}</th>
                                    <th>{{ __('Statu') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->getUser->name }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->getArticle->title }}</td>
                                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                                        <td><input class="switch" type="checkbox" name="my-checkbox" data-id="{{$comment->id}}" @if ($comment->statu==1) checked @endif data-toggle="toggle" data-size="mini" data-on="Onaylandı" data-off="Bekliyor" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <a href="" title="{{ __('Show') }}" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                                            <a href="{{ route('admin.comment.edit',$comment->id) }}" title="{{ __('Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('admin.comment.delete',$comment->id) }}" onclick="validate({{$comment->id}})" title="{{ __('Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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
<script>
$('.switch').change(function(){
    id = $(this).attr('data-id');
    statu = $(this).prop('checked');
    $.get("{{route('admin.comment.switch')}}", {id:id,statu:statu})
})
</script>
@endsection
