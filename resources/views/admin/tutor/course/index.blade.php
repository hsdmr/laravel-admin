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
            <a href="{{ route('admin.tutor.course.create') }}" class="btn btn-success btn-sm my-2">{{ __('main.Add New') }}</a>
            <div class="accordion" id="accordionExample">
                @foreach ($courses as $course)
                <div class="card">
                    <div class="card-header p-0" id="heading{{$course->id}}">
                        <button class="btn btn-link w-75 text-left" type="button" data-toggle="collapse" data-target="#collapseCourse{{$course->id}}" aria-expanded="true" aria-controls="collapseCourse{{$course->id}}">
                          {{$course->title}}
                        </button>
                        <span class="float-right p-2">
                            <a href="{{ url('/',$course->getSlug->slug) }}" title="{{ __('main.Show') }}" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                            <a href="{{ route('admin.tutor.course.edit',$course->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{ route('admin.tutor.course.delete',$course->id) }}" onclick="validate({{$course->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                        </span>
                    </div>
                    <div id="collapseCourse{{$course->id}}" class="collapse" aria-labelledby="heading{{$course->id}}" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample{{$course->id}}">
                                @foreach (App\Models\Lesson::where('course_id','=',$course->id)->where('lesson_id','=',null)->get() as $topic)
                                <div class="card">
                                    <div class="card-header p-0" id="heading{{$topic->id}}">
                                        <button class="btn btn-link w-75 text-left" type="button" data-toggle="collapse" data-target="#collapseTopic{{$topic->id}}" aria-expanded="true" aria-controls="collapseTopic{{$topic->id}}">
                                          {{$topic->title}}
                                        </button>
                                        <span class="float-right p-2">
                                            <a href="javascript:void(0)" onclick="editTopic({{$topic->id}})" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs topic-modal"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteTopic({{$topic->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                        </span>
                                    </div>
                                    <div id="collapseTopic{{$topic->id}}" class="collapse" aria-labelledby="heading{{$topic->id}}" data-parent="#accordionExample{{$course->id}}">
                                        <div class="card-body">
                                            @foreach (App\Models\Lesson::where('course_id','=',$course->id)->where('lesson_id','=',$topic->id)->get() as $lesson)
                                            <div>
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$lesson->id}}" aria-expanded="true" aria-controls="collapse{{$lesson->id}}">
                                                  {{$lesson->title}}
                                                </button>
                                                <span class="float-right p-2">
                                                    <a href="{{ route('admin.tutor.lesson.edit',$lesson->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('admin.tutor.lesson.delete',$lesson->id) }}" onclick="validate({{$lesson->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                                </span>
                                            </div>
                                            @endforeach
                                            <div class="lessonWillAdd">
                                            </div>
                                            <a href="{{ route('admin.tutor.lesson.create',[$course->id,$topic->id]) }}" class="btn-primary btn-sm topic-modal" data-topic="0" data-course="0">{{ __('main.Add New Lesson') }}</a>
                                            <a href="{{ route('admin.tutor.zoom.create',[$course->id,$topic->id]) }}" class="btn-primary btn-sm topic-modal" data-topic="0" data-course="0">{{ __('main.ZOOM') }}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="topicWillAdd">
                                </div>
                            </div>
                            <a href="javascript:void(0)" onclick="topicModalOpen(this)" class="btn-primary btn-sm topic-modal" data-topic="0" data-course="{{$course->id}}">{{ __('main.Add New Topic') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@include('admin.tutor.course.topic')
@endsection

@section('script')
<script>
function topicModalOpen(e){
    console.log(e.dataset.topic);
    $('#courseIdModal').val(e.dataset.course);
    $('#topicIdModal').val(e.dataset.topic);
    $('#topic-modal').modal('show');
}
</script>
@endsection
