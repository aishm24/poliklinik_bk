@extends('layout.main')
@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" /> --}}
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
            <h1 class="m-0">Data  Pasien</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pasien</li>
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

        <a href="{{route('create.pasien')}}" class="btn btn-primary" style="margin-bottom:8px">
          <i class="fa fa-plus"></i> Tambah Data
        </a>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="dataAdmin" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>NO</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>No. KTP</th>
                      <th>No Hp</th>
                      <th>No. RM</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->no_ktp}}</td>
                            <td>{{$item->no_hp}}</td>
                            <td>{{$item->no_rm}}</td>
                            <td>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-update{{$item->id}}"><i class="fas fa-pen"></i> Edit</a>
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$item->id}}"><i class="fas fa-trash-alt"> Hapus</i></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-update{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content bg-primary">
                                    <form action="{{route('update.pasien', ['id' => $item->id])}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Data</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="inputNama">Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" required value="{{$item->nama}}">
                                                  </div>
                                                @error('nama')
                                                      <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputAlamat">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" required value="{{$item->alamat}}">
                                                  </div>
                                                @error('alamat')
                                                      <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputNohp">No. Hp</label>
                                                    <input type="text" class="form-control" name="no_hp" id="inputNohp" placeholder="No. Hp" required value="{{$item->no_hp}}">
                                                  </div>
                                                @error('no_hp')
                                                      <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputNoktp">No. KTP</label>
                                                    <input type="text" class="form-control" name="no_ktp" id="inputNoktp" placeholder="No. KTP" required value="{{$item->no_ktp}}">
                                                  </div>
                                                @error('no_ktp')
                                                      <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputNorm">No. RM</label>
                                                    <input type="text" class="form-control" name="no_rm" id="inputNorm" placeholder="No. RM" disabled required value="{{$item->no_ktp}}">
                                                  </div>
                                                @error('no_rm')
                                                      <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-light">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        

                        <div class="modal fade" id="modal-hapus{{$item->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah ingin menghapus data Pasien <b>"{{$item->nama}}" ?</b></p>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <form action="{{route('delete.pasien', ['id' => $item->id])}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-outline-light">Hapus</button>
                                </form>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('lte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('lte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    {{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script> --}}
    <!-- Toastr -->
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Page specific script -->
<script>
    $(function () {
      $('#dataAdmin').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> 
@endsection