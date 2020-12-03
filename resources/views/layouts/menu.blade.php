    <header id="header" class="position-absolute" style="top: 0; left:0; right:0; z-index:500; height:90px">
        <nav class="navbar navbar-expand-lg navbar-light" style="height: 100%">
            <div class="container" style="height: 100%">
                @if($setting->logo==1)
                <a class="navbar-brand" href="{{url('/')}}">Has<b>Panel</b></a>
                @else
                <a class="navbar-brand" style="height: 100%" href="{{url('/')}}"><img style="max-height: 100%" src="{{$setting->getLogo->getUrl('thumb')}}" alt="Süper Doktorlar"></a>
                @endif
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav ml-auto">
                    @foreach(App\Models\Menu::orderBy('order', 'asc')->where('position','=',1)->get() as $menuItem)

                        @if( $menuItem->parent == null && $menuItem->title != null )
                           <li {{ $menuItem->children->isEmpty() ? '' : "class=dropdown" }} style="margin: 0 40px 0 0">
                           <a href="{{ $menuItem->children->isEmpty() ? url('/',$menuItem->link) : "#" }}"{{ $menuItem->children->isEmpty() ? '' : "class=dropdown-toggle data-toggle=dropdown role=button aria-expanded=false" }}>
                              {{ $menuItem->title }}
                           </a>
                        @endif

                        @if( ! $menuItem->children->isEmpty() )
                          <ul class="dropdown-menu" role="menu">
                            @foreach($menuItem->children as $subMenuItem)
                                <li><a style="display: block" href="{{ url('/',$subMenuItem->link) }}">{{ $subMenuItem->title }}</a></li>
                            @endforeach
                          </ul>
                        @endif
                        </li>

                    @endforeach
                    @if(Illuminate\Support\Facades\Auth::user())
                        @php
                            $user = Illuminate\Support\Facades\Auth::user();
                        @endphp
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{$user->name}} {{$user->surname}}
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if ($user->role=='admin')
                                <li><a style="display: block" href="{{route('admin.home')}}">Profilim</a></li>
                                @endif
                                <li><a style="display: block" href="{{route('logout')}}">Çıkış</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Giriş</a></li>
                    @endif
                </ul>
              </div>
            </div>
        </nav>
    </header>
