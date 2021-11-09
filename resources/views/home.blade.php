@extends('layouts.header_footer')

@section('main-section')
@if (Auth::user()->role == 0)
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <form method="POST" action="{{url('presensi')}}">
    @csrf
    <div class="card text-center mb-3">
        <div class="card-header">
          Presensi
        </div>
        <div class="card-body">
          <h5 class="card-title">Cek ID Karyawan Anda</h5>
          <p class="card-text">Pilih tipe presensi (Masuk/Pulang)</p>
          <div class="container overflow-hidden">
            <div class="row gx-5">
              <div class="col">
                <label class="form-label">ID Karyawan</label>
                <input type="text" class="form-control text-center" id="idKaryawan" name="idKaryawan" value="{{ Auth::user()->id_user }}" readonly>
                <div class="form-text">Pastikan menginput dengan benar</div>
              </div>
              <div class="col">
                <label class="form-label">Tipe Presensi</label>
                <select class="form-select" name="tipe" required>
                    <option value="">Pilih Tipe</option>
                    @if ($presenceIn->isEmpty())
                      <option value="1">Masuk</option>
                    @else
                      <option value="1" disabled>Masuk</option>
                    @endif
                    @if ($presenceOut->isEmpty())
                      <option value="2">Pulang</option>
                    @else
                      <option value="2" disabled>Pulang</option>
                    @endif
                  </select>
                <div class="form-text">Hanya bisa presensi masuk/pulang sekali</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Presensi Sekarang</button>
        </div>
        <div class="card-footer text-muted">
          {{'Today is '. date('l d-m-Y', strtotime($today))}}
        </div>
      </div>
</form>
@endif

  <div class="container overflow-hidden">
    <div class="row gx-5">
      <div class="col">
        <div class="card text-center">
            <div class="card-header">
              Masuk
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Waktu</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($presenceIn as $key => $psi)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('d-m-Y H:i:s', strtotime($psi->presence_date))}}</td>
                                <td>{{$psi->presence_name->name}}</td>
                                @if ($psi->status == 1)
                                    <td><span class="badge bg-success">Valid</span></td>
                                @else
                                  <td><span class="badge bg-warning">Tidak Valid</span></td>
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
      <div class="col">
        <div class="card text-center">
            <div class="card-header">
              Pulang
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Waktu</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($presenceOut as $key => $pso)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('d-m-Y H:i:s', strtotime($pso->presence_date))}}</td>
                                <td>{{$pso->presence_name->name}}</td>
                                @if ($pso->status == 1)
                                    <td><span class="badge bg-success">Valid</span></td>
                                @else
                                  <td><span class="badge bg-warning">Tidak Valid</span></td>
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