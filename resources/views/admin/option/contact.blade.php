@extends('admin.layouts.master')

@section('title')
{{ __('main.Contact Information') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Contact Information') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Contact Information') }}</li>
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
            <div class="card">
                <form action="{{ route('admin.option.contactUpdate') }}" method="post" id="form" >
                    @csrf
                    <input type="hidden" name="language" value="tr">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="cell" class="col-md-3">{{ __('main.Mobile Phone') }}</label>
                            <input type="text" class="form-control form-control-sm col-md-9" value="@isset($contact['cell']){{$contact['cell']}}@endisset" id="cell" name="contact[cell]">
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-3">{{ __('main.Phone') }}</label>
                            <input type="text" class="form-control form-control-sm col-md-9" value="@isset($contact['phone']){{$contact['phone']}}@endisset" id="phone" name="contact[phone]">
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3">{{ __('main.E-mail') }}</label>
                            <input type="text" class="form-control form-control-sm col-md-9" value="@isset($contact['email']){{$contact['email']}}@endisset" id="email" name="contact[email]">
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-3">{{ __('main.Address') }}</label>
                            <input type="text" class="form-control form-control-sm col-md-9" value="@isset($contact['address']){{$contact['address']}}@endisset" id="address" name="contact[address]">
                        </div>
                        <div class="form-group row">
                            <label for="map" class="col-md-3">{{ __('main.Map') }}</label>
                            <div class="input-group col-md-6 row">
                                <input type="text" class="form-control form-control-sm" id="map" name="contact[map]" value="{{isset($contact['map'])? $contact['map'] : 'Ayasofya'}}">
                                <div class="input-group-append" style="cursor: pointer" id="search">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                            <label for="zoom" class="col-md-1">{{ __('main.Zoom') }}</label>
                            <input type="range" id="zoom" name="contact[zoom]" class="col-md-2" min="1" max="20" value="@isset($contact['zoom']){{$contact['zoom']}}@endisset" step="1">
                        </div>
                    </div>
                </form>
                <iframe style="width: 100%; height:500px;" id="gmap_canvas" src="https://maps.google.com/maps?q=Ayasofya&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <div class="card" id="save-card">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('main.Save') }}</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@endsection

@section('script')
<script>
    var map = "{{isset($contact['map'])? $contact['map'] : 'Ayasofya'}}";
    var zoom = "{{isset($contact['zoom'])? $contact['zoom'] : '13'}}";
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
