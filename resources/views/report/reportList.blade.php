@extends('layouts.header_footer')

@section('main-section')
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <form method="POST" autocomplete="off" target="_blank" action="{{url('reportSearch')}}">
    @csrf
    <div class="card text-center mb-3">
        <div class="card-header">
          Report
        </div>
        <div class="card-body">
          <div class="container overflow-hidden">
            <div class="col mb-3">
                <label class="form-label">ID Karyawan</label>
                @if (Auth::user()->role == 0)
                    <input type="text" class="form-control text-center" id="idKaryawan" name="idKaryawan" value="{{ Auth::user()->id_user }}" readonly>
                @else
                    <select class="form-control form-select" name="idKaryawan" required>
                        <option value="">Pilih Karyawan</option>
                            @foreach($users as $u)--}}
                                <option value="{{$u->id_user}}">{{$u->id_user.' - '.$u->name}}</option>--}}
                            @endforeach
                    </select>
                @endif
                {{-- <input type="text" class="form-control text-center" id="idKaryawan" name="idKaryawan" value="{{ Auth::user()->id_user }}"> --}}
            </div>
            <div class="row gx-5">
              <div class="col">
                <label class="form-label">Dari Tanggal</label>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" name="tgl1" value="{{$source}}" placeholder="Pilih Tanggal">
                    <span class="input-group-append">
                    </span>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Sampai Tanggal</label>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" name="tgl2" value="{{$source2}}" placeholder="Pilih Tanggal">
                    <span class="input-group-append">
                    </span>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Pilih Laporan</label>
                <select class="form-control form-select" required name="reportname">
                    <option value="">Pilih Report</option>
                    <option value="1">Kehadiran</option>
                    <option value="2">Ketidakhadiran</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label">Aksi</label>
                <select class="form-control form-select" required id="actionvalue"
                    name="type_value" data-placeholder="Select Action">
                <option <?php if ($type == 1) echo 'selected'; ?> value="1">Lihat
                    Report
                </option>
                <option <?php if ($type == 2) echo 'selected'; ?> value="2" disabled>Download Excel
                </option>
            </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Search</button>
        </div>
      </div>
</form>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datepicker').datepicker({
                dateFormat: "dd-mm-yy",
            });
        });
    </script>
@endsection