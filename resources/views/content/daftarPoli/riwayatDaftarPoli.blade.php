@extends('layout.main')
@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
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
            <h1 class="m-0">Detail Daftar Poli</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Poli</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Informasi Poli</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <th>Nama Poli</th>
                        <td>{{ $item->jadwalPeriksa->dokter->poli->nama_poli ?? 'Data tidak tersedia' }}</td>
                      </tr>
                      <tr>
                        <th>Nama Dokter</th>
                        <td>{{ $item->jadwalPeriksa->dokter->nama ?? 'Data tidak tersedia' }}</td>
                      </tr>
                      <tr>
                        <th>Hari</th>
                        <td>{{ $item->jadwalPeriksa->hari ?? 'Data tidak tersedia' }}</td>
                      </tr>
                      <tr>
                        <th>Jam Mulai</th>
                        <td>{{ $item->jadwalPeriksa->jam_mulai ?? 'Data tidak tersedia' }}</td>
                      </tr>
                      <tr>
                        <th>Jam Selesai</th>
                        <td>{{ $item->jadwalPeriksa->jam_selesai ?? 'Data tidak tersedia' }}</td>
                      </tr>
                      <tr>
                        <th>Nomor Antrian</th>
                        <td>{{ $item->no_antrian ?? '-' }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              <div class="card-body">
                <h3 class="mb-3">Riwayat Pemeriksaan</h3>
                @if(count($dataRiwayat) > 0)
                  @foreach ($dataRiwayat as $riwayat)
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title"><strong>Tanggal Periksa:</strong> {{ $riwayat['tgl_periksa'] }}</h5>
                      <p class="card-text"><strong>Catatan:</strong> {{ $riwayat['catatan'] }}</p>
                      <p class="card-text"><strong>Daftar Obat:</strong></p>
                      <ul>
                        @foreach ($riwayat['obat'] as $obat)
                        <li>{{ $obat }}</li>
                        @endforeach
                      </ul>
                      <p class="card-text"><strong>Biaya Periksa:</strong> Rp. {{ number_format($riwayat['biaya_periksa'], 0, ',', '.') }}</p>
                    </div>
                  </div>
                  @endforeach
                @else
                  <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
                @endif
              </div>

              <div class="card-footer">
                <a href="{{route('index.daftarpoli')}}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
@endsection
