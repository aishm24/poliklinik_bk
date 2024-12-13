@extends('layout.main')
@section('css')
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('lte/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profil Dokter</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">Nama</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Name" disabled value="{{$dokter->nama}}">
                      </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" class="form-control" id="inputAlamat" placeholder="Alamat" disabled value="{{$dokter->alamat}}">
                      </div>
                      <div class="form-group">
                        <label for="inputNo.Hp">No. Hp</label>
                        <input type="text" class="form-control" id="inputNo.Hp" placeholder="No.Hp" disabled value="{{$dokter->no_hp}}">
                      </div>
                    <div class="form-group">
                        <label for="inputPoli">Poli</label>
                        <input type="text" class="form-control" id="inputPoli" placeholder="Poli" disabled value="{{$dokter->poli->nama_poli}}">
                      </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Update Profil</a>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Profil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update.profil.dokter', ['id' => $dokter->id ]) }}" method="POST">
                @csrf
                <div class="modal-body">
                  
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                    <div class="form-group">
                        <label for="inputName">Nama</label>
                        <input type="text" class="form-control" name="nama" id="inputName" placeholder="Nama" value="{{old('nama', $dokter->nama)}}">
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="{{old('alamat', $dokter->alamat)}}">
                    </div>
                    <div class="form-group">
                        <label for="inputNo.Hp">No. Hp</label>
                        <input type="text" class="form-control" name="no_hp" id="inputNo.Hp" placeholder="No.Hp" value="{{old('no_hp', $dokter->no_hp)}}">
                    </div>
                    <div class="form-group">
                        <label for="inputPoli">Poli</label>
                        <input type="text" class="form-control" name="poli" id="inputPoli" placeholder="Poli" disabled value="{{old('poli', $dokter->poli->nama_poli)}}">
                    </div>
                    <div class="form-group">
                        <label for="passwordLama">Password</label>
                        <input type="password" class="form-control" name="password_lama" id="passwordLama" required placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="passwordBaru">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" name="password_baru" id="passwordBaru" placeholder="Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="passwordBaruConfirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="password_confirmation" id="passwordBaruConfirmation" placeholder="Konfirmasi Password Baru">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
  <!-- SweetAlert2 -->
  {{-- <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
  <!-- Toastr -->
  <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>

  <script>
    @if($errors->any())
      $(document).ready(function() {
        $('#modal-lg').modal('show'); // Membuka modal
      });
    @endif
  </script>

@endsection