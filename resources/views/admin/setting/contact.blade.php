@extends('admin.layouts.master')

@section('title')
{{ __('Contact Information') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Contact Information') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Settings') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Contact Information') }}</li>
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
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.setting.contactUpdate',1) }}" method="post" id="form" >
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="cell" class="col-md-3">{{ __('Mobile Phone') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$contact->cell}}" id="cell" name="cell">
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-3">{{ __('Phone') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$contact->phone}}" id="phone" name="phone">
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3">{{ __('E-mail') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$contact->email}}" id="email" name="email">
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-md-3">{{ __('Address') }}</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$contact->address}}" id="address" name="address">
                                </div>
                                <div class="form-group row">
                                    <label for="map" class="col-md-3">{{ __('Map') }}</label>
                                    <div class="input-group col-md-6 row">
                                        <input type="text" class="form-control form-control-sm" id="map" name="map" value="{{$contact->map}}">
                                        <div class="input-group-append" style="cursor: pointer" id="search">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                    </div>
                                    <label for="zoom" class="col-md-1">{{ __('Zoom') }}</label>
                                    <input type="range" id="zoom" name="zoom" class="col-md-2" min="1" max="20" value="{{$contact->zoom}}" step="1">
                                </div>
                            </div>
                        </form>
                        <iframe style="width: 100%; height:500px;" id="gmap_canvas" src="https://maps.google.com/maps?q=İstanbul%20Alerji Ataşehir&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>                        <div class="card-footer">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('Save') }}</a>
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
    var map = "{{$contact->map}}";
    var zoom = "{{$contact->zoom}}";
    $("#gmap_canvas").attr("src","https://maps.google.com/maps?q="+map+"&t=&z="+zoom+"&ie=UTF8&iwloc=&output=embed");
$(function(){

    $("#zoom").on("change",function(){
        map = $("#map").val().replace(" ","%20").replace(":","%3A");
        zoom = $("#zoom").val();
        $("#gmap_canvas").attr("src","https://maps.google.com/maps?q="+map+"&t=&z="+zoom+"&ie=UTF8&iwloc=&output=embed");
    });
    $("#search").click(function(){
        map = $("#map").val().replace(" ","%20").replace(":","%3A");
        zoom = $("#zoom").val();
        $("#gmap_canvas").attr("src","https://maps.google.com/maps?q="+map+"&t=&z="+zoom+"&ie=UTF8&iwloc=&output=embed");
    });
});
</script>
@endsection
