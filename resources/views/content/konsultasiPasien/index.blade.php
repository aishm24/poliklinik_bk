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
                    <h1 class="m-0">Konsultasi Medis Pasien</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Konsultasi</li>
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

            <a href="{{route('form.konsultasi.pasien')}}" class="btn btn-primary" style="margin-bottom:8px">
                <i class="fa fa-plus"></i> Tambah Data
            </a>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="margin-bottom:8px">
                            <h3 class="card-title">Daftar Konsultasi Medis Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="dataAdmin" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Konsultasi</th>
                                        <th>Nama Dokter</th>
                                        <th>Subject</th>
                                        <th>Pertanyaan</th>
                                        <th>Tanggapan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->tgl_konsultasi}}</td>
                                        <td>{{$item->dokter->nama}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{$item->pertanyaan}}</td>
                                        <td>{{$item->jawaban}}</td>
                                        <td>
                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-update{{$item->id}}"><i class="fas fa-pen"></i> Edit</a>
                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$item->id}}"><i class="fas fa-trash-alt"> Hapus</i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-update{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-primary">
                                                <form action="{{route('update.konsultasi', ['id' => $item->id])}}" method="post">
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
                                                                <label for="inputNamaPasien">Nama Pasien</label>
                                                                <input type="text" class="form-control" name="nama_pasien" id="inputNamaPasien" placeholder="Nama Pasien" readonly value="{{Auth::user()->name}}">
                                                            </div>
                                                            @error('nama_pasien')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="inputNamaDokter">NamaDokter</label>
                                                                <input type="text" class="form-control" name="Nama_dokter" id="inputNamaDokter" placeholder="NamaDokter" readonly value="{{$item->dokter->nama}}">
                                                            </div>
                                                            @error('Nama_dokter')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="inputsubject">Subject</label>
                                                                <input type="text" class="form-control" name="subject" id="inputsubject" placeholder="Subject" required value="{{old('subject', $item->subject)}}">
                                                            </div>
                                                            @error('subject')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="inputpertanyaan">Pertanyaan</label>
                                                                <input type="text" class="form-control" name="pertanyaan" id="inputpertanyaan" placeholder="pertanyaan" readonly value="{{$item->pertanyaan}}">
                                                            </div>
                                                            @error('pertanyaan')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="inputtanggapan">Tanggapan</label>
                                                                <input type="text" class="form-control" name="tanggapan" id="inputtanggapan" placeholder="tanggapan" readonly value="{{$item->jawaban}}">
                                                            </div>
                                                            @error('tanggapan')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="inputTanggal">Tanggal Konsultasi</label>
                                                                <input type="text" class="form-control" id="inputTanggal" placeholder="Tanggal" readonly value="{{$item->tgl_konsultasi}}">
                                                            </div>
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
                                                    <p>Apakah ingin menghapus data Konsultasi ini?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <form action="{{route('delete.konsultasi', ['id' => $item->id])}}" method="POST">
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
    $(function() {
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