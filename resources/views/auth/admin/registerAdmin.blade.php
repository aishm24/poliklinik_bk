<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{route('register.admin')}}" class="h1"><b>Register</b>Admin</a>
    </div>
    <div class="card-body">
      <form action="{{route('submit.register.admin')}}" method="post">
        @csrf

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="input-group mb-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required value="{{old('name')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span> <!-- Ikon user -->
              </div>
            </div>
          </div>
          @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

          
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="{{old('email')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span> <!-- Ikon KTP -->
              </div>
            </div>
          </div>
          @error('email')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          
          <div class="input-group mb-3">
            <input type="text" name="password" id="password" class="form-control" placeholder="Password" required value="{{old('password')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span> <!-- Ikon telepon -->
              </div>
            </div>
          </div>
          @error('password')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
        <p class="mb-0">
            <a href="{{route('login.admin')}}" class="text-center">Silahkan Login</a>
          </p>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('lte/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
