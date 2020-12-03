@extends('admin.layouts.master')

@section('title')
{{ __('Kategoriler') }}
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
            <h4 class="m-0 text-dark">{{ __('Kategoriler') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Kategoriler') }}</li>
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
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success btn-sm">Yeni Ekle</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>İsim</th>
                                    <th>Slug</th>
                                    <th>Ebeveyn Kategori</th>
                                    <th>Açıklama</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><img src="{{ ($category->getMedia->id==1) ? '' : $category->getMedia->getUrl('thumb')}}" alt="" style="height: 26px"></td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->getSlug->slug }}</td>
                                        <td>@foreach ($categories as $categoryupper)
                                            @if ($category->upper==$categoryupper->id)
                                                {{ $categoryupper->title }}
                                            @endif
                                        @endforeach</td>
                                        <td>{{ $category->desc }}</td>
                                        <td>
                                            <a href="{{ url('/',$category->getSlug->slug) }}" title="Görüntüle" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                                            <a href="{{ route('admin.category.edit',$category->id) }}" title="Düzenle" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete_{{$category->id}}" action="{{route('admin.category.destroy',$category->id)}}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{$category->id}})" title="Sil" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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

</script>
@endsection
