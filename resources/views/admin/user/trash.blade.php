@extends('admin.layouts.master')

@section('title')
{{ __('main.Users Recycle') }}
@endsection

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">{{ __('main.Users Recycle') }}</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Anasayfa') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ __('main.Users') }}</a></li>
              <li class="breadcrumb-item active">{{ __('main.Recycle') }}</li>
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
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('main.Name') }}</th>
                                <th>{{ __('main.E-mail') }}</th>
                                <th>{{ __('main.Role') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.recover',$user->id) }}" title="{{ __('main.Recover') }}" class="btn btn-warning btn-xs"><i class="fas fa-recycle"></i></a>
                                        <form id="delete_{{$user->id}}" action="{{route('admin.user.destroy',$user->id)}}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <a href="javascript:void(0)" onclick="validate({{$user->id}})" title="{{ __('main.Destroy') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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
