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
            <h1 class="m-0">Detail Riwayat Pasien</h1>
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
      <div class="container-fluid">

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="margin-bottom:8px">
                  <h3 class="card-title">Riwayat Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table id="dataAdmin" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Keluhan</th>
                            <th>Catatan</th>
                            <th>Obat</th>
                            <th>Biaya Periksa</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($dataRiwayat as $riwayat)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $riwayat['tgl_periksa'] }}</td>
                              <td>{{$riwayat['nama_dokter']}}</td>
                              <td>{{$riwayat['keluhan']}}</td>
                              <td>{{$riwayat['catatan']}}</td>
                              <td>{{ $riwayat['catatan'] }}</td>
                              <td>
                                  <ul>
                                      @foreach ($riwayat['obat'] as $obat)
                                          <li>{{ $obat }}</li>
                                      @endforeach
                                  </ul>
                              </td>
                              <td>Rp {{ number_format($riwayat['biaya_periksa'], 0, ',', '.') }}</td>
                          </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{route('index.riwayatpasien')}}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                  </a>
                </div>
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
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection