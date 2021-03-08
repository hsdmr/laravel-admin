@extends('admin.layouts.master')

@section('title')
{{ __('main.Add New Course') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Add New Course') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tutor.course.index') }}">{{ __('main.Tutor') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Add New Course') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.tutor.course.store') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="media_id" id="media_id" value="">
                <input type="hidden" value="form" name="type" value="1">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="title">{{ __('main.Name') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="slug">{{ __('main.Permalink') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="">
                                </div>
                                <div class="form-group">
                                    <label for="content">{{ __('main.Description') }}</label>
                                    <textarea class="form-control form-control-sm" rows="3" id="content" name="content"></textarea>
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
                                <div class="form-group ">
                                    <label for="total_time">{{ __('main.Total Course Time') }}</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" value="00" id="total_time" name="total_time_H">
                                            <small>{{ __('main.Hour') }}</small>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" value="00" min="00" max="59" id="total_time" name="total_time_H">
                                            <small>{{ __('main.Minute') }}</small>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control form-control-sm" value="00" min="00" max="59" id="total_time" name="total_time_H">
                                            <small>{{ __('main.Second') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="what_to_learn">{{ __('main.What Will You Learn?') }}</label>
                                    <textarea class="form-control form-control-sm" rows="3" id="what_to_learn" name="what_to_learn"></textarea>
                                    <small>{{__("main.Put one item per line and * at the end of the line")}}</small>
                                </div>
                                <div class="form-group ">
                                    <label for="requirements">{{ __('main.Requirements / Instructions') }}</label>
                                    <textarea class="form-control form-control-sm" rows="3" id="requirements" name="requirements"></textarea>
                                    <small>{{__("main.Put one item per line and * at the end of the line")}}</small>
                                </div>
                                <div class="form-group ">
                                    <label for="for_who">{{ __('main.Who Is This Course For?') }}</label>
                                    <textarea class="form-control form-control-sm" rows="3" id="for_who" name="for_who"></textarea>
                                    <small>{{__("main.Put one item per line and * at the end of the line")}}</small>
                                </div>
                                <div class="form-group ">
                                    <label for="includes">{{ __("main.What's Included?") }}</label>
                                    <textarea class="form-control form-control-sm" rows="3" id="includes" name="includes"></textarea>
                                    <small>{{__("main.Put one item per line and * at the end of the line")}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label for="">{{ __("main.Course Intro video") }}</label>
                            </div>
                            <div class="card-body">
                                <input type="text" name="intro" id="intro" class="form-control form-control-sm" value="">
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
                                    <option value="{{$language->language}}">{{$language->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <label for="media_img">{{ __('main.Featured Image') }}</label>
                            </div>
                            <div class="card-body">
                                <img src="" alt="" id="media_img" class="w-100">
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
                                            <option value="{{$category->id}}">{{$category->title}}</option>
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
                                    <input type="radio" name="price_type" id="price_type_paid">
                                    <label for="price_type_paid" class="mr-3">{{ __("main.Paid") }}</label>
                                    <input type="radio" name="price_type" id="price_type_free">
                                    <label for="price_type_free">{{ __("main.Free") }}</label>
                                </div>
                                <div id="price-zone">
                                    <div class="form-group row">
                                        <label for="price" class="col-md-6">{{ __("main.Price") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="price" id="price ">
                                    </div>
                                    <div class="form-group row">
                                        <label for="discounted" class="col-md-6">{{ __("main.Discounted Price") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="discounted" id="discounted ">
                                    </div>
                                    <div class="form-group row">
                                        <label for="currency" class="col-md-6">{{ __("main.Currency") }}</label>
                                        <input type="text" class="form-control form-control-sm col-md-6" name="currency" id="currency ">
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

@endsection
