@extends('admin.layouts.master')

@section('title')
{{ __('Menus') }}
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
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Settings') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.menu.index') }}">{{ __('Menus') }}</a></li>
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
                                            <label for="page">{{ __('Pages') }}</label>
                                            <select name="page" id="page" class="form-control">
                                                <option value="">{{ __('Choose') }}</option>
                                                @foreach ($pages as $page)
                                                <option value="{{$page->getSlug->slug}}">{{$page->title}}</option>
                                                @endforeach
                                                <option value="login">{{ __('Login') }}</option>
                                                <option value="register">{{ __('Register') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">{{ __('Categories') }}</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">{{ __('Choose') }}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->getSlug->slug}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="article">{{ __('Posts') }}</label>
                                            <select name="article" id="article" class="form-control">
                                                <option value="">{{ __('Choose') }}</option>
                                                @foreach ($articles as $article)
                                                <option value="{{$article->getSlug->slug}}">{{$article->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div><b class="text-danger">{{ __('Reminders') }}</b>
                                        <ul style="padding-left:20px">
                                            <li class="mb-2">{{ __('Click side to select menu icon.') }} <a href="https://fontawesome.com/icons?d=gallery&m=free">{{ __('here') }}</a></li>
                                            <li class="mb-2">{{ __('Use the "Order" field to sort the menu items.') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('admin.setting.menu.store')}}" method="post" id="form">
                                                @csrf
                                                <input type="hidden" name="position" id="position" value="{{$menus[0]->position}}">
                                                <input type="hidden" name="menuname" id="menuname" value="{{$menus[0]->menuname}}">
                                                <div class="form-group">
                                                    <label for="title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" id="title" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="icon">{{ __('Icon') }}</label>
                                                    <input type="text" name="icon" id="icon" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">{{ __('Link') }}</label>
                                                    <input type="text" name="link" id="link" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="parent">{{ __('Parent') }}</label>
                                                    <select name="parent" id="parent" class="form-control">
                                                        <option value=""></option>
                                                        @foreach ($menus as $menu)
                                                        @if ($menu->title!=null)
                                                        <option value="{{$menu->id}}">{{$menu->title}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="order">{{ __('Order') }}</label>
                                                    <input type="number" name="order" id="order" class="form-control">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right" id="submit">{{ __('Save') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                  <tr>
                                                    <th style="width: 20px">{{ __('Order') }}</th>
                                                    <th>{{ __('Title') }}</th>
                                                    <th>{{ __('Link') }}</th>
                                                    <th style="width: 40px"></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    <tbody>
                                                        @php
                                                            menuOrder($menus);
                                                        @endphp
                                                    </tbody>
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
