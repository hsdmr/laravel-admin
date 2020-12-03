@include('layouts.header')
<body style="background-color:whitesmoke;">
    <h1 class="text-center" style="padding-top: 15rem"><a class="navbar-brand" href="{{url('/')}}" style="font-size: 5rem">Has<b>Panel</b></a></h1>
    <h3 class="text-danger text-center my-5"><b>Sayfa Bulunamadı!</b></h3>
    <div class="text-center" style="width:50%; margin:auto">
        <b>
        <p class="m-1">Açmaya çalıştığınız sayfa bulunamadı. Linki doğru girdiğinizden emin olunuz.</p>
        <p class="m-1">Aradığınız adreste bir sayfa olduğundan eminseniz <a href="mailto:bilgi@superdoktorlar.com">bize yazabilir</a> ya da <a href="{{url('/')}}">ana sayfaya</a>  dönerek yeni bir başlangıç yapabilirsiniz.</p>
        </b>
    </div>
</body>
