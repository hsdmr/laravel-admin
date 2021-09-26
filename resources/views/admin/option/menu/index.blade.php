@extends('admin.layouts.master')

@section('title')
    {{ __('main.Menus') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.Menus') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.option.index') }}">{{ __('main.Options') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.Menus') }}</li>
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
                    <div class="card-header">
                        <a href="{{ route('admin.option.menu.create') }}"
                            class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.Title') }}</th>
                                    <th>{{ __('main.Position') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $menu[0]->menuname }}</td>
                                        <td>
                                            <div>
                                                <input class="choose {{ $menu[0]->menuname }}" data-id="1"
                                                    data-name="{{ $menu[0]->menuname }}" @if ($menu[0]->position == 1) checked @endif
                                                    type="checkbox" id="main{{ $menu[0]->id }}"><label
                                                    for="main{{ $menu[0]->id }}"
                                                    class="pl-1">{{ __('main.Main Menu') }}</label>
                                            </div>
                                            <div>
                                                <input class="choose {{ $menu[0]->menuname }}" data-id="2"
                                                    data-name="{{ $menu[0]->menuname }}" @if ($menu[0]->position == 2) checked @endif
                                                    type="checkbox" id="footer{{ $menu[0]->id }}"><label
                                                    for="footer{{ $menu[0]->id }}"
                                                    class="pl-1">{{ __('main.Footer') }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.option.menu.show', $menu[0]->id) }}"
                                                title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form id="delete_{{ $menu[0]->id }}"
                                                action="{{ route('admin.option.menu.destroy', $menu[0]->id) }}"
                                                method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{ $menu[0]->id }})"
                                                    title="{{ __('main.Destroy') }}" class="btn btn-danger btn-xs"><i
                                                        class="fas fa-times"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $('.choose').change(function() {
            name = $(this).attr('data-name');
            id = $(this).attr('id');
            pos = $(this).attr('data-id');
            status = $(this).prop('checked');
            $.get("{{ route('admin.option.menu.position') }}", {
                pos: pos,
                id: id,
                status: status,
                name: name
            });
            window.location.reload()
        })
    </script>
@endsection
