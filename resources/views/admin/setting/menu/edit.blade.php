@extends('admin.layouts.master')

@section('title')
{{ __('Menüler') }}
@endsection

@section('header')
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ $menus[0]->menuname }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Ayarlar') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.menu.index') }}">{{ __('Menuler') }}</a></li>
              <li class="breadcrumb-item active">{{ $menus[0]->menuname }}</li>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card card-body">
                                        <div class="form-group">
                                            <label for="page">Sayfalar</label>
                                            <select name="page" id="page" class="form-control">
                                                <option value="">Seçiniz</option>
                                                @foreach ($pages as $page)
                                                <option value="{{$page->getSlug->slug}}">{{$page->title}}</option>
                                                @endforeach
                                                <option value="giris">Giriş</option>
                                                <option value="kayit-uzman">Doktor Kayıt</option>
                                                <option value="kayit-uye">Üye Kayıt</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Kategoriler</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Seçiniz</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->getSlug->slug}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="article">Yazılar</label>
                                            <select name="article" id="article" class="form-control">
                                                <option value="">Seçiniz</option>
                                                @foreach ($articles as $article)
                                                <option value="{{$article->getSlug->slug}}">{{$article->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div><b class="text-danger">Hatılatmalar</b>
                                        <ul style="padding-left:20px">
                                            <li class="mb-2">Menü ikonu seçmek için <a href="https://fontawesome.com/icons?d=gallery&m=free">buraya</a> tıklayın.</li>
                                            <li class="mb-2">Menü elemanlarını sıralamak için '<b>Sıra</b>' alanını kullanınız.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('admin.setting.menu.update',$menu->id)}}" method="post" id="form">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="position" id="position" value="{{$menu->position}}">
                                                <input type="hidden" name="menuname" id="menuname" value="{{$menu->menuname}}">
                                                <div class="form-group">
                                                    <label for="title">Başlık</label>
                                                    <input type="text" name="title" id="title" class="form-control" value="{{$menu->title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="icon">İkon</label>
                                                    <input type="text" name="icon" id="icon" class="form-control" value="{{$menu->icon}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link</label>
                                                    <input type="text" name="link" id="link" class="form-control" value="{{$menu->link}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="parent">Üst Menü</label>
                                                    <select name="parent" id="parent" class="form-control">
                                                        <option value=""></option>
                                                        @foreach ($menus as $mnu)
                                                        @if ($mnu->title!=null)
                                                        <option value="{{$mnu->id}}" @if($mnu->id==$menu->parent) selected @endif>{{$mnu->title}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="order">Sıra</label>
                                                    <input type="number" name="order" id="order" class="form-control" value="{{$menu->order}}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">Kaydet</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                  <tr>
                                                    <th style="width: 20px">Sıra</th>
                                                    <th>Başlık</th>
                                                    <th>Link</th>
                                                    <th style="width: 40px"></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        menuOrder($menus);
                                                    @endphp
                                                </tbody>
                                              </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    $("#page").change(function(){
        var title = "";
        var link = "";
        $("#page option:selected").each(function(){
            title = $( this ).text();
            link = $(this).val();
        });
        $("#title").val( title );
        $("#link").val( link );
    });
    $("#article").change(function(){
        var title = "";
        var link = "";
        $("#article option:selected").each(function(){
            title = $( this ).text();
            link = $(this).val();
        });
        $("#title").val( title );
        $("#link").val( link );
    });
    $("#category").change(function(){
        var title = "";
        var link = "";
        $("#category option:selected").each(function(){
            title = $( this ).text();
            link = $(this).val();
        });
        $("#title").val( title );
        $("#link").val( link );
    });
</script>
@endsection
