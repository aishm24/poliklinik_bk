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
            <h1 class="m-0">Tambah Data Poli</h1>
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
                    <form action="{{route('submit.create.poli')}}" method="post">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamePoli">Nama Poli</label>
                            <input type="text" class="form-control" name="nama_poli" id="inputNamePoli" placeholder="Nama Poli" required value="{{old('nama_poli')}}">
                          </div>
                        @error('nama_poli')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="inputKeteranganPoli">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="inputKeteranganPoli" placeholder="Keterangan" required value="{{old('keterangan')}}">
                          </div>
                        @error('keterangan')
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