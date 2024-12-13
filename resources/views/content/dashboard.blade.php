@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Welcome Message -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="m-0 text-dark">Selamat Datang di Sistem Poliklinik BK</h1>
                <p class="lead text-muted mt-2">
                    Kami menyediakan layanan terbaik untuk mempermudah Anda dalam mengelola janji temu, jadwal periksa, dan riwayat pasien.
                </p>
            </div>
        </div>

        <!-- About the System -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4><i class="fas fa-info-circle"></i> Apa itu Sistem Poliklinik BK?</h4>
                    <p>
                        Sistem ini membantu Anda dalam mengatur aktivitas poliklinik, seperti mengelola data pasien, menjadwalkan pemeriksaan, dan mencatat riwayat konsultasi dengan mudah dan efisien.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Overview -->
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-calendar-check text-primary"></i></h3>
                        <p>Atur jadwal pemeriksaan dan kelola janji temu pasien secara praktis melalui fitur yang tersedia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-notes-medical text-success"></i></h3>
                        <p>Periksa riwayat kesehatan pasien dengan cepat untuk mendukung layanan kesehatan yang lebih baik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-users text-warning"></i></h3>
                        <p>Kelola data pasien dan informasi terkait dengan mudah dan terorganisir dalam satu sistem.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="text-muted">
                    Sistem ini dirancang untuk memberikan kemudahan dalam pengelolaan poliklinik. Hubungi kami jika Anda membutuhkan bantuan lebih lanjut.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
