
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="https://hsdmrsoft.com">HsdmrSOFT</a>.</strong> Tüm Hakları Saklıdır.
    </footer>
</div>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/jscroll.min.js"></script>
<script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/adminlte.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/script.js"></script>
<script src="{{ asset('admin') }}/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>




@if (session('message'))
    @if(session('type') == 'info')
        <script>
            toastr.info('{{ session("message") }} ');
        </script>
    @endif
    @if(session('type') == 'success')
        <script>
            toastr.success('{{ session("message") }} ');
        </script>
    @endif
    @if(session('type') == 'warning')
        <script>
            toastr.warning('{{ session("message") }} ');
        </script>
    @endif
    @if(session('type') == 'error')
        <script>
            toastr.error('{{ session("message") }} ');
        </script>
    @endif
@endif
