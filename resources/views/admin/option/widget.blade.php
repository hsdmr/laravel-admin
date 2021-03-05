@extends('admin.layouts.master')

@section('title')
{{ __('main.Widgets') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Widgets') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Widgets') }}</li>
            </ol>
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
                @php
                    $i = 0
                @endphp
                @foreach ($widgets as $widget)
                @php
                    $i++
                @endphp
                <div class="col-3">
                    <div class="card">
                        <form action="{{route('admin.option.widgetUpdate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$i}}">
                        <div class="card-header">
                            <label>{{$widget->name}}</label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title{{$i}}">{{ __('main.Title') }}</label>
                                <input type="text" name="title{{$i}}" id="title{{$i}}" class="form-control form-control-sm" value="{{$widget->title}}">
                            </div>
                            <div class="form-group">
                                <label for="menu{{$i}}">{{ __('main.Menu') }}</label>
                                <select name="menu{{$i}}" id="menu{{$i}}" class="form-control form-control-sm">
                                    <option value=""></option>
                                    @foreach ($menus as $menu)
                                        <option value="{{$menu[0]->menuname}}" @if($widget->menu==$menu[0]->menuname) selected @endif>{{$menu[0]->menuname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content{{$i}}">{{ __('main.Content') }}</label>
                                <textarea name="content{{$i}}" id="content{{$i}}" cols="30" rows="10" class="form-control form-control-sm">{{$widget->content}}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm float-right">{{ __('main.Save') }}</button>
                        </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@endsection
@section('script')
<script>
$(function() {
    $('#content1').summernote();
    $('#content2').summernote();
    $('#content3').summernote();
    $('#content4').summernote();
})
</script>
@endsection
