@extends('layout.main')
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konsultasi Medis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Konsultasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Konsultasi Medis Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('create.konsultasi.pasien')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputNoRM">Nomor Rekam Medis</label>
                                    <input type="text" class="form-control" id="inputNoRM" placeholder="NoRM" disabled value="{{Auth::user()->pasien->no_rm}}">
                                </div>
                                <div class="form-group">
                                    <label for="id_dokter">Pilih Dokter</label>
                                    <select id="id_dokter" name="id_dokter" class="form-control" required>
                                        <option value="">Pilih Dokter</option>
                                        @foreach($dokter as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_dokter')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <textarea id="subject" name="subject" class="form-control" required></textarea>
                                    @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <textarea id="pertanyaan" name="pertanyaan" class="form-control" required></textarea>
                                    @error('pertanyaan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Periksa:</label>
                                    <input type="datetime-local" class="form-control" name="tgl_konsultasi" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')

<script>
    document.getElementById('id_poli').addEventListener('change', function() {
        const poliId = this.value;
        const jadwalDropdown = document.getElementById('id_jadwal');

        if (poliId) {
            // Fetch data jadwal dari endpoint
            fetch(`/daftar-poli/jadwal?id_poli=${poliId}`)
                .then(response => response.json())
                .then(data => {
                    // Reset dropdown jadwal
                    jadwalDropdown.innerHTML = '<option value="">Pilih Jadwal</option>';

                    if (data.status === 'success') {
                        // Tambahkan opsi baru ke dropdown jadwal
                        data.data.forEach(jadwal => {
                            const option = document.createElement('option');
                            option.value = jadwal.id;
                            option.textContent = `${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai}) - ${jadwal.dokter}`;
                            jadwalDropdown.appendChild(option);
                        });
                    } else {
                        // Tampilkan pesan error jika ada
                        alert(data.message || 'Terjadi kesalahan saat mengambil data jadwal.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching jadwal:', error);
                    alert('Gagal mengambil data jadwal. Silakan coba lagi nanti.');
                });
        } else {
            // Reset dropdown jadwal jika poli tidak dipilih
            jadwalDropdown.innerHTML = '<option value="">Pilih Jadwal</option>';
        }
    });
</script>

@endsection