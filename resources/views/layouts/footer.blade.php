<footer style="background-color: gray; ">
    <div class="container py-4" style="color: white;">
      <div class="row">
        <div class="col-md-3 " style="color: white;">
            @isset($widget[0]->title)<h4 style="color:white; font-weight:bolder;">{{$widget[0]->title}}</h4>@endisset
            @isset($widget[0]->content){!!$widget[0]->content!!}@endisset
            @isset($widget[0]->menu)
            <ul>
                @foreach (App\Models\Menu::orderBy('order', 'asc')->where('menuname','=',$widget[0]->menu)->get() as $menuItem)
                @if( $menuItem->parent == null && $menuItem->title != null )
                   <li><a href="{{ $menuItem->children->isEmpty() ? url('/',$menuItem->link) : "#" }}">{{ $menuItem->title }}</a></li>
                @endif

                @if( ! $menuItem->children->isEmpty() )
                    @foreach($menuItem->children as $subMenuItem)
                        <li><a href="{{ url('/',$subMenuItem->link) }}">- {{ $subMenuItem->title }}</a></li>
                    @endforeach
                @endif
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="col-md-3 " style="color: white;">
            @isset($widget[1]->title)<h4 style="color:white; font-weight:bolder;">{{$widget[1]->title}}</h4>@endisset
            @isset($widget[1]->content){!!$widget[1]->content!!}@endisset
            @isset($widget[1]->menu)
            <ul>
                @foreach (App\Models\Menu::orderBy('order', 'asc')->where('menuname','=',$widget[1]->menu)->get() as $menuItem)
                @if( $menuItem->parent == null && $menuItem->title != null )
                   <li><a href="{{ $menuItem->children->isEmpty() ? url('/',$menuItem->link) : "#" }}">{{ $menuItem->title }}</a></li>
                @endif

                @if( ! $menuItem->children->isEmpty() )
                    @foreach($menuItem->children as $subMenuItem)
                        <li><a href="{{ url('/',$subMenuItem->link) }}">- {{ $subMenuItem->title }}</a></li>
                    @endforeach
                @endif
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="col-md-3 " style="color: white;">
            @isset($widget[2]->title)<h4 style="color:white; font-weight:bolder;">{{$widget[2]->title}}</h4>@endisset
            @isset($widget[2]->content){!!$widget[2]->content!!}@endisset
            @isset($widget[2]->menu)
            <ul>
                @foreach (App\Models\Menu::orderBy('order', 'asc')->where('menuname','=',$widget[2]->menu)->get() as $menuItem)
                @if( $menuItem->parent == null && $menuItem->title != null )
                   <li><a href="{{ $menuItem->children->isEmpty() ? url('/',$menuItem->link) : "#" }}">{{ $menuItem->title }}</a></li>
                @endif

                @if( ! $menuItem->children->isEmpty() )
                    @foreach($menuItem->children as $subMenuItem)
                        <li><a href="{{ url('/',$subMenuItem->link) }}">- {{ $subMenuItem->title }}</a></li>
                    @endforeach
                @endif
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="col-md-3 " style="color: white;">
            @isset($widget[3]->title)<h4 style="color:white; font-weight:bolder;">{{$widget[3]->title}}</h4>@endisset
            @isset($widget[3]->content){!!$widget[3]->content!!}@endisset
            @isset($widget[3]->menu)
            <ul>
                @foreach (App\Models\Menu::orderBy('order', 'asc')->where('menuname','=',$widget[3]->menu)->get() as $menuItem)
                @if( $menuItem->parent == null && $menuItem->title != null )
                   <li><a href="{{ $menuItem->children->isEmpty() ? url('/',$menuItem->link) : "#" }}">{{ $menuItem->title }}</a></li>
                @endif

                @if( ! $menuItem->children->isEmpty() )
                    @foreach($menuItem->children as $subMenuItem)
                        <li><a href="{{ url('/',$subMenuItem->link) }}">- {{ $subMenuItem->title }}</a></li>
                    @endforeach
                @endif
                @endforeach
            </ul>
            @endisset
        </div>
      </div>
    </div>
    <div class="col-md-12 border-top p-3" style="color: white;">
      <div class="text-center">HasPanel © 2020 - Tüm Hakları Saklıdır.</div>
    </div>
  </footer>

  <script src="{{ asset('front') }}/js/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('front') }}/js/bootstrap.min.js"></script>

