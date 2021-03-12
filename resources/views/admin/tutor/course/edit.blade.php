@extends('admin.layouts.master')

@section('title')
{{ __('main.Edit Course') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Edit Course') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
              <li class="breadcrumb-item active">{{ $course->title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.tutor.course.update',$course->id) }}" method="post" id="form">
                @method('PUT')
                @csrf
                <input type="hidden" name="media_id" id="media_id" value="{{$course->media_id}}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="title">{{ __('main.Name') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{$course->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">{{ __('main.Permalink') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{$course->getSlug->slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="summary">{{ __('main.Description') }}</label>
                                    <textarea class="form-control form-control-s summary" rows="3" name="content">{{$course->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".topic-modal-xl">{{ __('main.Add New Topic') }}</button>
                            </div>
                            <div class="card-body" id="courses">

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label for="">{{__('main.Additional info')}}</label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3">{{ __('main.Difficulty Level') }}</label>
                                    <div class="form-group col-md-9">
                                        <label class="mr-3">
                                            <input class="mr-1" type="radio" value="0" name="difficulty" id="diff_all" @if($course->difficulty==0) checked @endif>{{ __("main.All Levels") }}</label>
                                        <label class="mr-3">
                                            <input class="mr-1" type="radio" value="1" name="difficulty" id="diff_easy" @if($course->difficulty==1) checked @endif>{{ __("main.Beginner") }}</label>
                                        <label class="mr-3">
                                            <input class="mr-1" type="radio" value="2" name="difficulty" id="diff_medium" @if($course->difficulty==2) checked @endif>{{ __("main.Intermediate") }}</label>
                                        <label class="mr-3">
                                            <input class="mr-1" type="radio" value="3" name="difficulty" id="diff_hard" @if($course->difficulty==3) checked @endif>{{ __("main.Expert") }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="total_time">{{ __('main.Total Course Time') }}</label>
                                    <div class="row col-md-9">
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" name="time[h]" value="{{$course->time['h']}}">
                                            <small>{{ __('main.Hour') }}</small>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" min="00" max="59" name="time[m]" value="{{$course->time['m']}}">
                                            <small>{{ __('main.Minute') }}</small>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" min="00" max="59" name="time[s]" value="{{$course->time['s']}}">
                                            <small>{{ __('main.Second') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="what_to_learn">{{ __('main.What Will You Learn?') }}</label>
                                    <textarea class="form-control form-control-sm col-md-9" rows="3" id="what_to_learn" name="what_to_learn">{{$course->what_to_learn}}</textarea>
                                    <small class="ml-auto">{{__("main.Put one item per line")}}</small>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="requirements">{{ __('main.Requirements / Instructions') }}</label>
                                    <textarea class="form-control form-control-sm col-md-9" rows="3" id="requirements" name="requirements">{{$course->requirements}}</textarea>
                                    <small class="ml-auto">{{__("main.Put one item per line")}}</small>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="for_who">{{ __('main.Who Is This Course For?') }}</label>
                                    <textarea class="form-control form-control-sm col-md-9" rows="3" id="for_who" name="for_who">{{$course->for_who}}</textarea>
                                    <small class="ml-auto">{{__("main.Put one item per line")}}</small>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="includes">{{ __("main.What's Included?") }}</label>
                                    <textarea class="form-control form-control-sm col-md-9" rows="3" id="includes" name="includes">{{$course->includes}}</textarea>
                                    <small class="ml-auto">{{__("main.Put one item per line")}}</small>
                                </div>
                            </div>
                        </div>
                        @php
                            $arr = preg_split("/[\r\n]/", $course->requirements);
                            array_shift($arr);
                        @endphp
                        <!--<ul>
                            @foreach ($arr as $item)
                            @if ($item!="")
                            <li>{{$item}}</li>
                            @endif
                            @endforeach
                        </ul>-->
                        <div class="card">
                            <div class="card-header">
                                <label for="">{{ __("main.Course Intro video") }}</label>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control form-control-sm" id="video" rows="3" name="video">{{$course->video}}</textarea>
                            </div>
                        </div>
                        @include('admin.layouts.slug')
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <label for="language">{{ __('main.Language') }}</label>
                            </div>
                            <div class="card-body">
                                <select name="language" id="language" class="form-control form-control-sm">
                                    @foreach ($languages as $language)
                                    <option value="{{$language->language}}" @if($course->language==$language->language) selected @endif>{{$language->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label for="media_img">{{ __('main.Featured Image') }}</label>
                            </div>
                            <div class="card-body">
                                <img src="{{ ($course->getMedia->id==1) ? '' : $course->getMedia->getUrl()}}" alt="" id="media_img" class="w-100">
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">{{ __('main.Choose Image') }}</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">{{ __('main.Remove Image') }}</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label for="upper">{{ __('main.Category') }}</label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" id="upper" name="upper">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if($course->category_id==$category->id) checked @endif>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label>{{ __("main.Course Type") }}</label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mr-3">
                                        <input class="mr-1" type="radio" value="paid" name="price[type]" @if($course->price['type']=='paid') checked @endif>{{ __("main.Paid") }}</label>
                                    <label class="mr-3">
                                        <input class="mr-1" type="radio" value="free" name="price[type]" @if($course->price['type']=='free') checked @endif>{{ __("main.Free") }}</label>
                                </div>
                                <div id="price-zone" @if($course->price['type']=='free') style="display:none;" @endif>
                                    <div class="form-group row">
                                        <label for="price" class="col-md-6">{{ __("main.Price") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="price[cost]" value="{{$course->price['cost']}}" id="price" placeholder="eg: 60">
                                    </div>
                                    <div class="form-group row">
                                        <label for="discounted" class="col-md-6">{{ __("main.Discounted Price") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="price[discounted]" value="{{$course->price['discounted']}}" id="discounted" placeholder="eg: 45">
                                    </div>
                                    <div class="form-group row">
                                        <label for="currency" class="col-md-6">{{ __("main.Currency") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="price[currency]" value="{{$course->price['currency']}}" id="currency" placeholder="eg: $,₺,£">
                                    </div>
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
<script>
    $('input[name="price[type]"]').change(function(){
        if($('input[name="price[type]"]:checked').val()=='free'){
            $('#price-zone').css('display','none');
            $('#price').val('');
            $('#discounted').val('');
            $('#currency').val('');
        }
        else{
            $('#price-zone').css('display','block');
        }
    })
</script>
@endsection
