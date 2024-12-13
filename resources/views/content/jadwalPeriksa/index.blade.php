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
            <h1 class="m-0">Data Jadwal Periksa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jadwal Periksa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif

    
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

        <a href="{{route('create.jadwalperiksa')}}" class="btn btn-primary" style="margin-bottom:8px">
          <i class="fa fa-plus"></i> Tambah Data
        </a>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Jadwal Periksa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="dataAdmin" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Dokter</th>
                      <th>Hari</th>
                      <th>Jam Mulai</th>
                      <th>Jam Selesai</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->dokter->nama}}</td>
                            <td>{{$item->hari}}</td>
                            <td> {{$item->jam_mulai}}</td>
                            <td> {{$item->jam_selesai}}</td>
                            <td> {{$item->status === 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                            <td>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit{{$item->id}}"><i class="fas fa-pen"></i> Edit Status</a>
                                {{-- <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$item->id}}"><i class="fas fa-trash-alt"> Hapus</i></a> --}}
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-edit{{$item->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                                <form action="{{route('update.jadwalperiksa', ['id' => $item->id])}}" method="POST">
                                  @csrf
                                  @method('put')
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Status</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputNama">Nama Dokter</label>
                                            <input type="text" class="form-control" id="inputNama" placeholder="Nama Dokter" disabled value="{{$item->dokter->nama}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputHari">Hari</label>
                                            <input type="text" class="form-control" id="inputHari" placeholder="Hari" disabled value="{{$item->hari}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputJamMulai">Jam Mulai</label>
                                            <input type="text" class="form-control" id="inputJamMulai" placeholder="JamMulai" disabled value="{{$item->jam_mulai}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputJamSelesai">Jam Selesai</label>
                                            <input type="text" class="form-control" id="inputJamSelesai" placeholder="JamSelesai" disabled value="{{$item->jam_selesai}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-light">Update Status</button>
                                </div>
                            </form>
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