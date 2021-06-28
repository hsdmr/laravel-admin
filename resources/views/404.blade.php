@include('layouts.header')
<body style="background-color:whitesmoke;">
    <h1 class="text-center" style="padding-top: 15rem"><a class="navbar-brand" href="{{url('/')}}" style="font-size: 5rem">Site Name</a></h1>
    <h3 class="text-danger text-center my-5"><b>{{__('front.Page not Found')}}</b></h3>
    <div class="text-center" style="width:50%; margin:auto">
        <b>
            <p class="m-1">{{__('front.sureLinks')}}</p>
            @php
                $mailto = '<a href="mailto:bilgi@hsdmrsoft.com">'.__("front.Contact Us").'</a>';
                $home = '<a href="'.url("/").'">'.__("front.Home").'</a>';
            @endphp
            <p class="m-1">{!!__('front.mailTo',['mailto' => $mailto, 'home' => $home])!!}</p>
            </b>
    </div>
</body>
