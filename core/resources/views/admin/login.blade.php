<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grocery || Admin-Login</title>

     <!-- Font Awesome -->
     <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">

</head>
<body class="hold-transition login-page">

    <div class="login-box">

        <div class="card">
            <div class="card-body login-card-body text-center">
                @if(session()->has('alert'))
                  <p class="text-danger">{{ session('alert') }}</p>
                @endif

                <p class="login-box-msg">{{ __('Login To Go Dashboard') }}</p>

                <form action="{{ route('admin.auth') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="" placeholder="{{ __('Email') }}">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                          </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="" class="form-control" value="" placeholder="{{ __('Password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('LOGIN') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>



    <!-- jQuery 3 -->
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>

</body>
</html>
