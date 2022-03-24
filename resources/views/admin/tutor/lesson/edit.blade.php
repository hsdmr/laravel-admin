@extends('admin.layouts.master')

@section('title')
{{ __('main.Add New Lesson') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Add New Lesson') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Courses') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Add New Lesson') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.tutor.lesson.update',$lesson->id) }}" method="post" id="form">
                @csrf
                <input type="hidden" name="media_id" id="media_id" value="">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="title">{{ __('main.Name') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$lesson->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="summary">{{ __('main.Description') }}</label>
                                    <textarea class="form-control form-control-sm summary" rows="3" name="content">{{$lesson->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3" for="video">{{ __('main.Video') }}</label>
                                    <textarea class="form-control form-control-sm col-md-9" id="video" rows="3" name="video">{{$lesson->video}}</textarea>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="total_time">{{ __('main.Video Playing Time') }}</label>
                                    <div class="row col-md-9">
                                        <div class="col-md-3">
                                            <input type="number" class="form-control form-control-sm" value="{{$lesson->time['h']}}" id="total_time" name="time[h]">
                                            <small>{{ __('main.Hour') }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control form-control-sm" value="{{$lesson->time['h']}}" min="00" max="59" id="total_time" name="time[m]">
                                            <small>{{ __('main.Minute') }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control form-control-sm" value="{{$lesson->time['h']}}" min="00" max="59" id="total_time" name="time[s]">
                                            <small>{{ __('main.Second') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <label for="media_img">{{ __('main.Featured Image') }}</label>
                            </div>
                            <div class="card-body">
                                <img src="{{ ($lesson->getMedia->id==1) ? '' : $course->getMedia->getUrl() ?? ''}}" alt="" id="media_img" class="w-100">
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">{{ __('main.Choose Image') }}</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">{{ __('main.Remove Image') }}</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mr-3">
                                        <input type="checkbox" name="preview" @if($lesson->preview==1) checked @endif>
                                        {{ __('main.Enable Course Preview') }}
                                    </label>
                                    <small>
                                        {{ __('main.If checked, any users/guest can view this lesson without enroll course')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="save-card">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('main.Update') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@include('admin.layouts.media')
@endsection

@section('script')

@endsection
