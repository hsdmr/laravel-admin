@extends('admin.layouts.master')

@section('title')
{{ __('main.Categories') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Categories') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Categories') }}</li>
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
                    <a href="{{ route('admin.tutor.category.create') }}" class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('main.Image') }}</th>
                                <th>{{ __('main.Name') }}</th>
                                <th>{{ __('main.Permalink') }}</th>
                                <th>{{ __('main.Parent') }}</th>
                                <th>{{ __('main.Description') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td><img src="{{ ($category->getMedia->id==1) ? '' : $category->getMedia->getUrl('thumb')}}" alt="" style="height: 26px"></td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->getSlug->slug }}</td>
                                    <td>@foreach ($categories as $categoryupper)
                                        @if ($category->upper==$categoryupper->id)
                                            {{ $categoryupper->title }}
                                        @endif
                                    @endforeach</td>
                                    <td>{{ $category->desc }}</td>
                                    <td>
                                        <a href="{{ url('/',$category->getSlug->slug) }}" title="{{ __('main.Show') }}" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                                        <a href="{{ route('admin.tutor.category.edit',$category->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <form id="delete_{{$category->id}}" action="{{route('admin.tutor.category.destroy',$category->id)}}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <a href="javascript:void(0)" onclick="validate({{$category->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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
