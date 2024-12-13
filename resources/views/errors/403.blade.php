@extends('layout.main')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="container text-center">
    <h1>403</h1>
    <p>{{ $message ?? 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
