@extends('admin.layouts.master')

@section('title')
{{ __('main.Add New Student') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Add New Student') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.tutor.student.index') }}">{{ __('main.Students') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Add New Student') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.tutor.student.store') }}" method="post" id="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">{{ __('main.E-mail') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="email" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('main.Name') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <label for="surname">{{ __('main.Surname') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="surname" name="surname" value="">
                                </div>
                                <div class="form-group">
                                    <label for="role">{{ __('main.Role') }}</label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        <option value="student">{{ __('main.Student') }}</option>
                                        <option value="user">{{ __('main.User') }}</option>
                                        <option value="admin">{{ __('main.Admin') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('main.Password') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="password" name="password" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="course">{{ __('main.Course') }}</label>
                                    <select class="form-control form-control-sm" id="course" name="course">
                                        <option value="">{{__('main.Choose')}}</option>
                                        @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="keys[]" value="student_courses">
                                <div id="courses">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="save-card">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('main.Save') }}</a>
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
<script>
    $('#course').change(function(){
        var id = $('#course option:selected').val();
        var title = $('#course option:selected').html();
        if(id!=""){
            $('#courses').append('<div class="row mx-0 mb-1 border-bottom"><input type="hidden" name="metas[student_courses]['+id+']" value="'+title+'"><span>'+title+'</span><a class="btn btn-xs btn-danger ml-auto px-2" href="javascript:void(0);" onclick="this.parentNode.remove()">&times;</a></div>')
        }
    });
</script>
@endsection
