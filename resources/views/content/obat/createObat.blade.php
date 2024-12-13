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
            <h1 class="m-0">Tambah Data Obat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
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
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('submit.create.obat')}}" method="post">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="inputNameObat">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" id="inputNameObat" placeholder="Nama Obat" required value="{{old('nama_obat')}}">
                          </div>
                        @error('nama_obat')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="inputKemasan">Kemasan</label>
                            <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" required value="{{old('kemasan')}}">
                          </div>
                        @error('kemasan')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="inputHarga">Harga</label>
                            <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga" required value="{{old('harga')}}">
                          </div>
                        @error('harga')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                </div>

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
    
@endsection