@extends('admin.layouts.master')

@section('title')
{{ __('main.Social Media') }}
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Social Media') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Social Media') }}</li>
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
            <form action="{{ route('admin.option.socialUpdate') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="language" value="tr">
                <div class="card">
                    <div class="card-body">
                        @php $i = 0; @endphp
                        @foreach ($socials as $social)
                        <div class="form-group row">
                            <select name="social[{{$i}}][name]" class="form-control form-control-sm col-md-3 mr-1">
                                <option @if($social['name']=='Github')selected @endif value="Github">Github</option>
                                <option @if($social['name']=='Dribble')selected @endif value="Dribble">Dribble</option>
                                <option @if($social['name']=='Facebook')selected @endif value="Facebook">Facebook</option>
                                <option @if($social['name']=='Flickr')selected @endif value="Flickr">Flickr</option>
                                <option @if($social['name']=='Instagram')selected @endif value="Instagram">Instagram</option>
                                <option @if($social['name']=='Linkedin')selected @endif value="Linkedin">Linkedin</option>
                                <option @if($social['name']=='Pinterest')selected @endif value="Pinterest">Pinterest</option>
                                <option @if($social['name']=='Reddit')selected @endif value="Reddit">Reddit</option>
                                <option @if($social['name']=='Skype')selected @endif value="Skype">Skype</option>
                                <option @if($social['name']=='Soundcloud')selected @endif value="Soundcloud">Soundcloud</option>
                                <option @if($social['name']=='Tumblr')selected @endif value="Tumblr">Tumblr</option>
                                <option @if($social['name']=='Twitter')selected @endif value="Twitter">Twitter</option>
                                <option @if($social['name']=='GitVimeohub')selected @endif value="Vimeo">Vimeo</option>
                                <option @if($social['name']=='Vk')selected @endif value="Vk">Vk</option>
                                <option @if($social['name']=='Xing')selected @endif value="Xing">Xing</option>
                                <option @if($social['name']=='Yelp')selected @endif value="Yelp">Yelp</option>
                                <option @if($social['name']=='Youtube')selected @endif value="Youtube">Youtube</option>
                                <option @if($social['name']=='Whatsapp')selected @endif value="Whatsapp">Whatsapp</option>
                                <option @if($social['name']=='Email')selected @endif value="Email">Email</option>
                            </select>
                            <input type="text" name="social[{{$i}}][url]" class="form-control form-control-sm col mr-1" value="{{$social['url']}}">
                            <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" onclick="$(this).parent().remove();">&times;</a>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                        <div id="social-row">
                            <div class="form-group row">
                                <select name="social[{{$i}}][name]" class="form-control form-control-sm col-md-3 mr-1">
                                    <option value="Github">Github</option>
                                    <option value="Dribble">Dribble</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Flickr">Flickr</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Linkedin">Linkedin</option>
                                    <option value="Pinterest">Pinterest</option>
                                    <option value="Reddit">Reddit</option>
                                    <option value="Skype">Skype</option>
                                    <option value="Soundcloud">Soundcloud</option>
                                    <option value="Tumblr">Tumblr</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Vimeo">Vimeo</option>
                                    <option value="Vk">Vk</option>
                                    <option value="Xing">Xing</option>
                                    <option value="Yelp">Yelp</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Email">Email</option>
                                </select>
                                <input type="text" data-id="{{$i}}" name="social[{{$i}}][url]" class="form-control form-control-sm col mr-1" value="">
                                <a href="javascript:void(0);" data-id="0" class="btn btn-outline-danger btn-sm" onclick="$(this).parent().remove();">&times;</a>
                            </div>
                        </div>
                        <div id="socials"></div>
                        <a href="javascript:void(0);" onclick="add()" class="btn btn-outline-success btn-sm px-4 float-right row">&#43;</a>
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
@endsection

@section('script')
<script>
    var social_i = $('#social-row input').attr('data-id');
    function add(){
        social_i++;
        var social = '<div id="social-row"><div class="form-group row"><select name="social['+social_i+'][name]" class="form-control form-control-sm col-md-3 mr-1"><option value="Github">Github</option><option value="Dribble">Dribble</option><option value="Facebook">Facebook</option><option value="Flickr">Flickr</option><option value="Instagram">Instagram</option><option value="Linkedin">Linkedin</option><option value="Pinterest">Pinterest</option><option value="Reddit">Reddit</option><option value="Skype">Skype</option><option value="Soundcloud">Soundcloud</option><option value="Tumblr">Tumblr</option><option value="Twitter">Twitter</option><option value="Vimeo">Vimeo</option><option value="Vk">Vk</option><option value="Xing">Xing</option><option value="Yelp">Yelp</option><option value="Youtube">Youtube</option><option value="Whatsapp">Whatsapp</option><option value="Email">Email</option></select><input type="text" name="social['+social_i+'][url]" class="form-control form-control-sm col mr-1" value=""><a href="javascript:void(0);" data-id="0" class="btn btn-outline-danger btn-sm" onclick="$(this).parent().remove();">&times;</a></div></div>';
        $('#socials').append(social);
    }
</script>
@endsection
