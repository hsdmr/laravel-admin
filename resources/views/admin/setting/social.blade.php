@extends('admin.layouts.master')

@section('title')
{{ __('Social Media') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Social Media') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Settings') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Social Media') }}</li>
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
                        <form action="{{ route('admin.setting.socialUpdate',1) }}" method="post" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="behance" class="col-md-3">Behance</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->behance}}" id="behance" name="behance">
                                </div>
                                <div class="form-group row">
                                    <label for="dribble" class="col-md-3">Dribble</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->dribble}}" id="dribble" name="dribble">
                                </div>
                                <div class="form-group row">
                                    <label for="facebook" class="col-md-3">Facebook</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->facebook}}" id="facebook" name="facebook">
                                </div>
                                <div class="form-group row">
                                    <label for="flickr" class="col-md-3">Flickr</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->flickr}}" id="flickr" name="flickr">
                                </div>
                                <div class="form-group row">
                                    <label for="instagram" class="col-md-3">Instagram</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->instagram}}" id="instagram" name="instagram">
                                </div>
                                <div class="form-group row">
                                    <label for="linkedin" class="col-md-3">Linkedin</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->linkedin}}" id="linkedin" name="linkedin">
                                </div>
                                <div class="form-group row">
                                    <label for="pinterest" class="col-md-3">Pinterest</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->pinterest}}" id="pinterest" name="pinterest">
                                </div>
                                <div class="form-group row">
                                    <label for="reddit" class="col-md-3">Reddit</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->reddit}}" id="reddit" name="reddit">
                                </div>
                                <div class="form-group row">
                                    <label for="skype" class="col-md-3">Skype</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->skype}}" id="skype" name="skype">
                                </div>
                                <div class="form-group row">
                                    <label for="soundcloud" class="col-md-3">Soundcloud</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->soundcloud}}" id="soundcloud" name="soundcloud">
                                </div>
                                <div class="form-group row">
                                    <label for="tumblr" class="col-md-3">Tumblr</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->tumblr}}" id="tumblr" name="tumblr">
                                </div>
                                <div class="form-group row">
                                    <label for="twitter" class="col-md-3">Twitter</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->twitter}}" id="twitter" name="twitter">
                                </div>
                                <div class="form-group row">
                                    <label for="vimeo" class="col-md-3">Vimeo</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->vimeo}}" id="vimeo" name="vimeo">
                                </div>
                                <div class="form-group row">
                                    <label for="vk" class="col-md-3">Vk</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->vk}}" id="vk" name="vk">
                                </div>
                                <div class="form-group row">
                                    <label for="xing" class="col-md-3">Xing</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->xing}}" id="xing" name="xing">
                                </div>
                                <div class="form-group row">
                                    <label for="yelp" class="col-md-3">Yelp</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->yelp}}" id="yelp" name="yelp">
                                </div>
                                <div class="form-group row">
                                    <label for="youtube" class="col-md-3">Youtube</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->youtube}}" id="youtube" name="youtube">
                                </div>
                                <div class="form-group row">
                                    <label for="whatsapp" class="col-md-3">Whatsapp</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->whatsapp}}" id="whatsapp" name="whatsapp">
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3">Email</label>
                                    <input type="text" class="form-control form-control-sm col-md-9" value="{{$social->email}}" id="email" name="email">
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
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

@endsection
