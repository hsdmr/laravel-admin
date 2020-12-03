
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item dropdown d-none d-sm-inline-block">
        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item dropdown-toggle">Yeni Ekle</a>
        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="{{route('admin.page.create')}}" class="dropdown-item">Sayfa</a></li>
            <li><a href="{{route('admin.article.create')}}" class="dropdown-item">Yazı</a></li>
            <li><a href="{{route('admin.category.create')}}" class="dropdown-item">Kategori</a></li>
            <li><a href="{{route('admin.media.create')}}" class="dropdown-item">Media</a></li>
            <li><a href="{{route('admin.user.create')}}" class="dropdown-item">Kullanıcı</a></li>
        </ul>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{count($suspend)!=0? count($suspend) : ''}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{count($suspend)!=0 ? count($suspend).' yeni bildirim var' : 'Bildirim yok'}}</span>
          @if (count($suspend)!=0)
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user-md mr-2"></i> 2 Onay bekleyen değişiklik var
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('admin.suspend.index')}}" class="dropdown-item dropdown-footer">Hepsini gör</a>
          @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
