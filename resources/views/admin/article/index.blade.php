@extends('admin.layouts.master')

@section('title')
{{ __('Yazılar') }}
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
            <h4 class="m-0 text-dark">{{ __('Yazılar') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Anasayfa') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Yazılar') }}</li>
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
                        <a href="{{ route('admin.article.create') }}" class="btn btn-success btn-sm">Yeni Ekle</a>
                        <a href="{{ route('admin.article.trash') }}" class="btn btn-warning btn-sm float-right"><i class="fas fa-trash-alt"></i> Geri Dönüşüm Kutusu</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>Başlık</th>
                                    <th>Kısa Ad</th>
                                    <th>Kategori</th>
                                    <th>Hit</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Durum</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td><img src="{{ ($article->getMedia->id==1) ? '' : $article->getMedia->getUrl('thumb')}}" alt="" style="height: 24px"></td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->getSlug->slug }}</td>
                                        <td>{{ $article->getCategory->title }}</td>
                                        <td>{{ $article->hit }}</td>
                                        <td>{{ $article->created_at->diffForHumans() }}</td>
                                        <td><input class="switch" type="checkbox" name="my-checkbox" data-id="{{$article->id}}" @if ($article->statu==1) checked @endif data-toggle="toggle" data-size="mini" data-on="Yayında" data-off="Taslak" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <a href="{{ url('/',$article->getSlug->slug) }}" title="Görüntüle" class="btn btn-success btn-xs"><i class="fas fa-arrow-right"></i></a>
                                            <a href="{{ route('admin.article.edit',$article->id) }}" title="Düzenle" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('admin.article.delete',$article->id) }}" onclick="validate({{$article->id}})" title="Sil" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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

$('.switch').change(function(){
    id = $(this).attr('data-id');
    statu = $(this).prop('checked');
    $.get("{{route('admin.article.switch')}}", {id:id,statu:statu})
})
</script>
@endsection
