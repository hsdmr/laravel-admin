<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="icon" sizes="48x48" href="{{App\Models\Setting::find(1)->getFavicon->getUrl()}}" type="image/x-icon" />
    <link rel="icon" href="{{asset('front')}}/favicon.png" type="image/x-icon" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>{{ __('main.Register') }}</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/dist/css/adminlte.min.css">
</head>


<body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="{{url('/')}}"><b>Has</b>Panel</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">{{ __('main.Register a new membership') }}</p>

          @if ($errors->any()) <div class="alert alert-danger">{{$errors->first()}}</div> @endif
          <form action="{{route('register')}}" method="post">@csrf
            <input type="hidden" name="role" value="user">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="{{ __('main.Name') }}" name="name" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="{{ __('main.Surname') }}" name="surname" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="{{ __('main.E-mail') }}" name="email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="{{ __('main.Password') }}" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="{{ __('main.Retype password') }}" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                  <label for="agreeTerms">
                    {{ __('main.I agree to the') }} <a href="#">{{ __('main.terms') }}</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('main.Register') }}</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!--
          <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google+
            </a>
          </div>-->

          <a href="{{route('login')}}" class="text-center">{{ __('main.I already have a membership') }}</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin')}}/dist/js/adminlte.min.js"></script>
</body>
</html>
