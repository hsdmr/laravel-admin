@extends('admin.layouts.master')

@section('title')
{{ __('Genel Ayarlar') }}
@endsection

@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/theme/base16-dark.css">
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Genel Ayarlar') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Genel Ayarlar') }}</li>
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
                        <form action="{{ route('admin.setting.update',1) }}" method="post" id="form">
                            @csrf
                            <input type="hidden" class="form-control form-control-sm col-md-9" value="{{$setting->logo}}" id="logo" name="logo">
                            <input type="hidden" class="form-control form-control-sm col-md-9" value="{{$setting->favicon}}" id="fav" name="favicon">
                            <div class="card-body row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label for="title" class="col-md-3">Site Adı</label>
                                        <input type="text" class="form-control form-control-sm col-md-9" value="{{$setting->title}}" id="title" name="title">
                                    </div>
                                    <div class="form-group row">
                                        <label for="headcss" class="col-md-3">Header Css</label>
                                        <textarea type="text" class="form-control form-control-sm col-md-9" id="headcss" name="headcss" rows="10">{{$setting->headcss}}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="headjs" class="col-md-3">Header Js</label>
                                        <textarea type="text" class="form-control form-control-sm col-md-9" id="headjs" name="headjs" rows="10">{{$setting->headjs}}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="footerjs" class="col-md-3">Footer Js</label>
                                        <textarea type="text" class="form-control form-control-sm col-md-9" id="footerjs" name="footerjs" rows="10">{{$setting->footerjs}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <label for="media_img">{{ __('Logo') }}</label>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="{{ ($setting->getLogo->id==1) ? '' : $setting->getLogo->getUrl()}}" alt="" id="logo_img" style="max-width: 100%">
                                        </div>
                                        <div class="card-footer">
                                            <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="logochoose">Görsel Seç</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="logoremove">Görseli Kaldır</a>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <label for="media_img">{{ __('Favicon') }}</label>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="{{ ($setting->getfavicon->id==1) ? '' : $setting->getfavicon->getUrl()}}" alt="" id="fav_img" style="max-width: 100%">
                                        </div>
                                        <div class="card-footer">
                                            <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="favchoose">Görsel Seç</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="favremove">Görseli Kaldır</a>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" @if ($setting->no_index==1) checked @endif id="no_index" name="no_index">
                                        <label for="no_index" class="custom-control-label">Seo No Index</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" @if ($setting->no_follow==1) checked @endif id="no_follow" name="no_follow">
                                        <label for="no_follow" class="custom-control-label">Seo No Follow</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">Kaydet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@include('admin.layouts.media')
@endsection

@section('script')
<script src= "https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/javascript/javascript.js"></script>
<script>

const cm1 = CodeMirror.fromTextArea(document.getElementById('headcss'), {
  lineNumbers: true,
  mode: "javascript",
  theme: "base16-dark"
});
const cm2 = CodeMirror.fromTextArea(document.getElementById('headjs'), {
  lineNumbers: true,
  mode: "javascript",
  theme: "base16-dark"
});
const cm3 = CodeMirror.fromTextArea(document.getElementById('footerjs'), {
  lineNumbers: true,
  mode: "javascript",
  theme: "base16-dark",
});

$('#logoremove').click(function(){
    $('#logo_img').attr('src','');
    $('#logo').val(1);
});
$('#favremove').click(function(){
    $('#fav_img').attr('src','');
    $('#fav').val(1);
});
$("#logochoose").click(function(){
    $("#value").val('logo');
    $(".overlay-back").css("display","block");
    $(".choose-panel").css("display","block");
    $("body").css("overflow","hidden");
});
$("#favchoose").click(function(){
    $("#value").val('fav');
    $(".overlay-back").css("display","block");
    $(".choose-panel").css("display","block");
    $("body").css("overflow","hidden");
});
$("#close").click(function(){
    $(".overlay-back").css("display","none");
    $(".choose-panel").css("display","none");
    $("body").css("overflow","unset");
});
$("#add").click(function(){
    var media_img = $("#onizleme").attr("src");
    var media_id = $("#media").val();
    var value = $("#value").val();
    $("#"+value+"_img").attr("src",media_img);
    $("#"+value).attr("value",media_id);

    $(".overlay-back").css("display","none");
    $(".choose-panel").css("display","none");
    $("body").css("overflow","unset");
});
$("#remove").click(function(){
    var media_img = "";
    var media_id = 1;
    $("#media_img").attr("src",media_img);
    $("#media_id").attr("value",media_id);
});
$('.choose-panel .thumbnail img').click(function(){
    var alt = $(this).attr("alt");
    var id = $(this).attr("id");
    var url = $(this).attr("data-url");
    var title = $(this).attr('data-title');
    $("#onizleme").attr("src",url);
    $("#media").val(id);
    $("#media_url").val(url);
    $("#media_title").val(title);
    $("#media_alt").val(alt);
    $("#form_img").attr("action",id);
});


</script>
@endsection
