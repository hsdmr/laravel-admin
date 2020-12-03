@extends('admin.layouts.master')

@section('title')
{{ __('Menüler') }}
@endsection

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('admin')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('Menüler') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">{{ __('Ayarlar') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Menüler') }}</li>
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
                    <div class="card-header">
                        <a href="{{ route('admin.setting.menu.create') }}" class="btn btn-success btn-sm">Yeni Ekle</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Başlık</th>
                                    <th>Pozisyon</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $menu[0]->menuname }}</td>
                                        <td>
                                            <div>
                                                <input class="choose {{$menu[0]->menuname}}" data-id="1" data-name="{{$menu[0]->menuname}}" @if ($menu[0]->position==1) checked @endif type="checkbox" id="main{{$menu[0]->id}}"><label for="main{{$menu[0]->id}}" class="pl-1">Ana Menü</label>
                                            </div>
                                            <div>
                                                <input class="choose {{$menu[0]->menuname}}" data-id="2" data-name="{{$menu[0]->menuname}}" @if ($menu[0]->position==2) checked @endif type="checkbox" id="footer{{$menu[0]->id}}"><label for="footer{{$menu[0]->id}}" class="pl-1">Footer</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.setting.menu.show',$menu[0]->id) }}" title="Düzenle" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete_{{$menu[0]->id}}" action="{{route('admin.setting.menu.destroy',$menu[0]->id)}}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{$menu[0]->id}})" title="Tamamen Sil" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<!-- DataTables -->
<script src="{{ asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function(){
        $('#table1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                    "sDecimal":        ",",
                    "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
                    "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoEmpty":      "Kayıt yok",
                    "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ".",
                    "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sProcessing":     "İşleniyor...",
                    "sSearch":         "Ara:",
                    "sZeroRecords":    "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst":    "İlk",
                        "sLast":     "Son",
                        "sNext":     "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                    },
                    "select": {
                        "rows": {
                            "_": "%d kayıt seçildi",
                            "0": "",
                            "1": "1 kayıt seçildi"
                        }
                    }
                }
        });
    });

$('.choose').change(function(){
    name = $(this).attr('data-name');
    id = $(this).attr('id');
    pos = $(this).attr('data-id');
    statu = $(this).prop('checked');
    $.get("{{route('admin.setting.menu.position')}}", {pos:pos,id:id,statu:statu,name:name});
    window.location.reload()
})
</script>
@endsection
