@extends('admin.layouts.master')

@section('title')
{{ __('main.Courses') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Courses') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Courses') }}</li>
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
                    <a href="{{ route('admin.tutor.course.create') }}" class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('main.Image') }}</th>
                                <th>{{ __('main.Name') }}</th>
                                <th>{{ __('main.Categories') }}</th>
                                <th>{{ __('main.Lessons') }}</th>
                                <th>{{ __('main.Students') }}</th>
                                <th>{{ __('main.Price') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td><img src="{{ ($course->getMedia->id==1) ? '' : $course->getMedia->getUrl('thumb')}}" alt="" style="height: 24px"></td>
                                <td>{{$course->title}}</td>
                                <td>{{$course->getCategory->title}}</td>
                                <td></td>
                                <td></td>
                                @php
                                    $price = unserialize($course->price);
                                @endphp
                                <td>
                                    @if ($price['type']=='free')
                                    {{ __('main.Free') }}
                                    @else
                                    @if($price['discounted']=='') {{$price['cost'].' '.$price['currency']}} @else <del>{{$price['cost'].' '.$price['currency']}}</del> {{$price['discounted'].' '.$price['currency']}} @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/',$course->getSlug->slug) }}" title="{{ __('main.Show') }}" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                                    <a href="{{ route('admin.tutor.course.edit',$course->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('admin.tutor.course.edit',$course->id) }}" onclick="validate({{$course->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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
