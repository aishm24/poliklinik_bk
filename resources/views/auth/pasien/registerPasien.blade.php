<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Pasien</title>

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
      <a href="{{route('register.pasien')}}" class="h1"><b>Register</b>Pasien</a>
    </div>
    <div class="card-body">
      <form action="{{route('submit.register.pasien')}}" method="post">
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
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required value="{{old('nama')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span> 
              </div>
            </div>
          </div>
          @error('nama')
            <small class="text-danger">{{ $message }}</small>
        @enderror

          
          <div class="input-group mb-3">
            <input type="text" name="no_ktp" id="no_ktp" class="form-control" placeholder="Nomor KTP" required value="{{old('no_ktp')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span> 
              </div>
            </div>
          </div>
          @error('no_ktp')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          
          <div class="input-group mb-3">
            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor HP" required value="{{old('no_hp')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span> 
              </div>
            </div>
          </div>
          @error('no_hp')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          
          <div class="input-group mb-3">
            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required value="{{old('alamat')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-map-marker-alt"></span> 
              </div>
            </div>
          </div>
          @error('alamat')
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
            <a href="{{route('login.pasien')}}" class="text-center">already have an account?</a>
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
