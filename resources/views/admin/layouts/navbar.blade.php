
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item dropdown d-none d-sm-inline-block">
        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item dropdown-toggle">{{ __('main.Add New') }}</a>
        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="{{route('admin.page.create')}}" class="dropdown-item">{{ __('main.Page') }}</a></li>
            <li><a href="{{route('admin.article.create')}}" class="dropdown-item">{{ __('main.Post') }}</a></li>
            <li><a href="{{route('admin.category.create')}}" class="dropdown-item">{{ __('main.Category') }}</a></li>
            <li><a href="{{route('admin.media.create')}}" class="dropdown-item">{{ __('main.Media') }}</a></li>
            <li><a href="{{route('admin.user.create')}}" class="dropdown-item">{{ __('main.User') }}</a></li>
        </ul>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{ __("main.No Notification") }}</span>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
