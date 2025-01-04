@extends('layout.main')
@section('css')
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('lte/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('lte/plugins/dropzone/min/dropzone.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}

  @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Periksa Pasien</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Memeriksa Pasien</li>
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
                    <form action="{{route('submit.periksapasien', ['id' => $daftarPoli->id])}}" method="post">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama Pasien</label>
                            <input type="text" class="form-control" name="nama_pasien" id="inputName" placeholder="Nama pasien" disabled required value="{{$daftarPoli->pasien->nama}}">
                          </div>
                        @error('nama_pasien')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                          <label>Tanggal Periksa:</label>
                          <input type="datetime-local" class="form-control" name="tgl_periksa" required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Tanggal Periksa:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" name="tgl_periksa" class="form-control datetimepicker-input" data-target="#reservationdatetime" required />
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="inputCatatan">Catatan</label>
                            <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan" required value="{{old('catatan')}}">
                          </div>
                        @error('catatan')
                              <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label>Obat</label>
                            <select class="select2" name="obat[]" multiple="multiple" data-placeholder="Pilih Obat" style="width: 100%;">
                                @foreach ($obat as $item)
                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">
                                        {{ $item->nama_obat }} | {{ $item->kemasan }} | Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputTotalBiaya">Total Biaya Periksa</label>
                            <input type="number" class="form-control" name="biaya_periksa" id="inputTotalBiaya" placeholder="Total Biaya" readonly>
                          </div>
                        @error('biaya_periksa')
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
    <!-- Select2 -->
  <script src="{{asset('lte/plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{asset('lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('lte/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('lte/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
  <!-- date-range-picker -->
  <script src="{{asset('lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- bootstrap color picker -->
  <script src="{{asset('lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Bootstrap Switch -->
  <script src="{{asset('lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
  <!-- BS-Stepper -->
  <script src="{{asset('lte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
  <!-- dropzonejs -->
  <script src="{{asset('lte/plugins/dropzone/min/dropzone.min.js')}}"></script>

  <script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $(function () {
        $('#reservationdatetime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss', 
                icons: {
                    time: 'far fa-clock',
                    // date: 'far fa-calendar',
                    // up: 'fas fa-arrow-up',
                    // down: 'fas fa-arrow-down',
                    // previous: 'fas fa-chevron-left',
                    // next: 'fas fa-chevron-right',
                    // today: 'far fa-calendar-check',
                    // clear: 'far fa-trash-alt',
                    // close: 'fas fa-times'
                }
            });
        });

        //Date and time picker
        // $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    })
  </script>
  <script>
    $(document).ready(function() {
        const biayaPeriksa = 150000;
        const obatSelect = $('.select2');
        const totalBiayaInput = $('#inputTotalBiaya');

        function hitungTotalBiaya() {
            let totalObat = 0;

            obatSelect.val().forEach(function(obatId) {
                const hargaObat = obatSelect.find(`option[value="${obatId}"]`).data('harga');
                totalObat += parseInt(hargaObat);
            });

            const totalBiaya = biayaPeriksa + totalObat;

            totalBiayaInput.val(totalBiaya);
            // totalBiayaInput.val(`${totalBiaya.toLocaleString('id-ID')}`);
        }

        obatSelect.on('change', hitungTotalBiaya);
    });

  </script>
@endsection