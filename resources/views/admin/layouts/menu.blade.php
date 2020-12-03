<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
    <img src="{{asset('admin')}}/img/logo.png" alt="HasPanel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style=""><b> Has</b> Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin')}}/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$auth->name." ".$auth->surname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link @if(Request::segment(2)=="home") active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Özet</p>
            </a>
          </li>

          <li class="nav-item has-treeview @if(Request::segment(2)=="media") menu-open @endif">
            <a href="{{ route('admin.media.index') }}" class="nav-link @if(Request::segment(2)=="media") active @endif">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>
                Medya
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="@if(Request::segment(2)=="media") display:block; @endif">
              <li class="nav-item">
                <a href="{{ route('admin.media.index') }}" class="nav-link @if(Request::segment(2)=="media" && Request::segment(3)!="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Kütüphane</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.media.create') }}" class="nav-link @if(Request::segment(2)=="media" && Request::segment(3)=="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Yükle</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(Request::segment(2)=="page") menu-open @endif">
            <a href="{{ route('admin.page.index') }}" class="nav-link @if(Request::segment(2)=="page") active @endif">
                <i class="nav-icon fas fa-copy"></i>
              <p>
                Sayfalar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="@if(Request::segment(2)=="page") display:block; @endif">
                <li class="nav-item">
                  <a href="{{ route('admin.page.index') }}" class="nav-link @if(Request::segment(2)=="page"&& Request::segment(3)!="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Tüm Sayfalar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.page.create') }}" class="nav-link @if(Request::segment(2)=="page" && Request::segment(3)=="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Yeni Ekle</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview @if(Request::segment(2)=="article" || Request::segment(2)=="category") menu-open @endif">
            <a href="{{ route('admin.media.index') }}" class="nav-link @if(Request::segment(2)=="article" || Request::segment(2)=="category") active @endif">
                <i class=" nav-icon fas fa-thumbtack"></i>
                <p>
                Yazılar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="@if(Request::segment(2)=="article") display:block; @endif">
                <li class="nav-item">
                  <a href="{{ route('admin.article.index') }}" class="nav-link @if(Request::segment(2)=="article" && Request::segment(3)!="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Tüm Yazılar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.article.create') }}" class="nav-link @if(Request::segment(2)=="article" && Request::segment(3)=="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Yeni Ekle</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.category.index') }}" class="nav-link @if(Request::segment(2)=="category") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Kategori</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.comment.index') }}" class="nav-link @if(Request::segment(2)=="comment") active @endif">
                <i class="fas fa-comments nav-icon"></i>
              <p>Yorumlar</p>
            </a>
          </li>
          <li class="nav-item has-treeview @if(Request::segment(2)=="user" ) menu-open @endif">
            <a href="{{ route('admin.user.index') }}" class="nav-link @if(Request::segment(2)=="user") active @endif">
                <i class=" nav-icon fas fa-user"></i>
                <p>
                Kullanıcılar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="@if(Request::segment(2)=="user") display:block; @endif">
                <li class="nav-item">
                  <a href="{{ route('admin.user.index') }}" class="nav-link @if(Request::segment(2)=="user" && Request::segment(3)!="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Tüm Kullanıcılar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.user.create') }}" class="nav-link @if(Request::segment(2)=="user" && Request::segment(3)=="create") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Yeni Ekle</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview @if(Request::segment(2)=="setting" ) menu-open @endif">
            <a href="{{ route('admin.setting.index') }}" class="nav-link @if(Request::segment(2)=="setting") active @endif">
                <i class=" nav-icon fas fa-cog"></i>
                <p>
                Ayarlar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="@if(Request::segment(2)=="setting") display:block; @endif">
                <li class="nav-item">
                  <a href="{{ route('admin.setting.index') }}" class="nav-link @if(Request::segment(2)=="setting" && Request::segment(3)=="index") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Genel Ayarlar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.setting.menu.index')}}" class="nav-link @if(Request::segment(2)=="setting" && Request::segment(3)=="menu") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Menüler</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.setting.widget')}}" class="nav-link @if(Request::segment(2)=="setting" && Request::segment(3)=="widget") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Bileşenler</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.setting.contact') }}" class="nav-link @if(Request::segment(2)=="setting" && Request::segment(3)=="contact") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>İletişim Bilgileri</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.setting.social') }}" class="nav-link @if(Request::segment(2)=="setting" && Request::segment(3)=="social") active @endif">
                    <ion-icon name="return-down-forward-outline"></ion-icon>
                    <p>Sosyal Media</p>
                  </a>
                </li>
            </ul>
          </li>
          <hr>

          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">
                <i class="nav-icon fas fa-power-off"></i>
                {{ __('Logout') }}
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
