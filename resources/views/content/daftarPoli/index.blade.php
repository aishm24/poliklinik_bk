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
            <h1 class="m-0">Daftar Poli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Poli</li>
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

        <a href="{{route('create.daftarpoli')}}" class="btn btn-primary" style="margin-bottom:8px; width:200px">
            <i class="fas fa-calendar-check"></i> Daftar Poli
          </a>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="margin-bottom:8px">
                  <h3 class="card-title">Riwayat Daftar Poli</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table id="dataAdmin" class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jadwalPeriksa->dokter->poli->nama_poli ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item->jadwalPeriksa->dokter->nama ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item->jadwalPeriksa->hari ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item->jadwalPeriksa->jam_mulai ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item->jadwalPeriksa->jam_selesai ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item->no_antrian ?? '-' }}</td>
                            <td>
                                <span class="px-2 py-1 text-white {{ $item->status === 'Belum diperiksa' ? 'bg-danger' : 'bg-success' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                              @if ($item->status === 'Belum diperiksa')
                                <a href="{{route('detail.daftarpoli', ['id' => $item->id])}}" class="btn btn-primary"><i class="fas fa-pen"></i> Detail</a>
                              @elseif ($item->status === 'Sudah diperiksa')
                                <a href="{{route('riwayat.daftarpoli', ['id' => $item->id])}}" class="btn btn-success"><i class="fas fa-book"></i> Riwayat</a>
                              @endif
                            </td>
                        </tr>
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