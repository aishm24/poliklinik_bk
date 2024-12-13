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
            <h1 class="m-0">Tambah Data Dokter</h1>
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
                    <form action="{{route('submit.register.dokter')}}" method="post">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamePoli">Nama</label>
                            <input type="text" class="form-control" name="nama" id="inputName" placeholder="Nama" required value="{{old('nama')}}">
                          </div>
                        @error('nama')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="inputAlamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" required value="{{old('alamat')}}">
                          </div>
                        @error('alamat')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="inputNohp">No. Hp</label>
                            <input type="text" class="form-control" name="no_hp" id="inputNohp" placeholder="No. Hp" required value="{{old('no_hp')}}">
                          </div>
                        @error('no_hp')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                          <label for="inputPoli">Pilih Poli</label>
                          <select class="form-control" name="poli" id="inputPoli" required>
                              @foreach ($data as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                              @endforeach
                          </select>
                        </div>
                        @error('poli')
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