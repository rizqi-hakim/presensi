@extends('layouts.header_footer')

@section('main-section')
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <form method="POST" autocomplete="off" action="{{url('sendSakit')}}">
    @csrf
    <div class="card text-center mb-3">
        <div class="card-header">
          Izin Sakit
        </div>
        <div class="card-body">
          <h5 class="card-title">Izin sakit dapat diinputkan H+3 sejak ketidakhadiran</h5>
          <p class="card-text">Anda dapat memantau approval izin sakit dari manajer/atasan pada tabel dibawah</p>
          <div class="container overflow-hidden">
            <div class="row gx-5">
              <div class="col">
                <label class="form-label">ID Karyawan</label>
                <input type="text" class="form-control text-center" id="idKaryawan" name="idKaryawan" value="{{ Auth::user()->id_user }}" readonly>
                <div class="form-text">Pastikan ID anda sesuai</div>
              </div>
              <div class="col">
                <label class="form-label">Tanggal izin</label>
                <div class="input-group date">
                    <input type="text" class="form-control" id="datepicker" name="permit_date">
                    <span class="input-group-append">
                    </span>
                </div>
                <div class="form-text">Pastikan menginput dengan benar</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Kirim Permohonan Izin</button>
        </div>
        <div class="card-footer text-muted">
        </div>
      </div>
</form>

  <div class="container overflow-hidden">
    <div class="row gx-5">
      <div class="col">
        <div class="card text-center">
            <div class="card-header">
              Riwayat Izin Sakit
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Tanggal Izin</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($sakit as $key => $sk)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('d-m-Y', strtotime($sk->permit_date))}}</td>
                                <td>{{$sk->permit_name->name}}</td>
                                @if ($sk->status == 1)
                                    <td><span class="badge bg-success">Approve</span></td>
                                @else
                                  <td><span class="badge bg-warning">Pending</span></td>
                                @endif
                              </tr>
                            @empty
                            <tr>
                              <td colspan="4" class="text-center">Data not available !</td>
                            </tr>
                            @endforelse
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datepicker').datepicker({
                dateFormat: "dd-mm-yy",
                // maxDate:'+1m +10d',
                minDate: -3
            });
        });
    </script>
@endsection