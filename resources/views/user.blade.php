@extends('layouts.header_footer')

@section('main-section')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<form method="POST" action="{{route('storeUser')}}">
  @csrf
  <div class="card text-center mb-3">
      <div class="card-header">
        Tambah Pengguna
      </div>
      <div class="card-body">
        <h5 class="card-title">Tambah ID pengguna Anda</h5>
        <p class="card-text">Pilih tipe pengguna (Admin/Karyawan)</p>
        <div class="container overflow-hidden">
          <div class="row gx-5">
            <div class="col">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control text-center" id="name" name="name" value="" required>
              <div class="form-text">Pastikan menginput dengan benar</div>
            </div>
            <div class="col">
              <label class="form-label">Email</label>
              <input type="email" class="form-control text-center" id="email" name="email" value="" required>
              <div class="form-text">Pastikan menginput dengan benar</div>
            </div>
            <div class="col">
              <label class="form-label">Password</label>
              <input type="password" class="form-control text-center" id="password" name="password" value="" required>
              <div class="form-text">Pastikan menginput dengan benar</div>
            </div>
            <div class="col">
              <label class="form-label">Pilih Role</label>
              <select class="form-control form-select" required name="role">
                  <option value="">Pilih Role</option>
                  <option value="1">Admin</option>
                  <option value="0">Karyawan</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Tambah</button>
      </div>
    </div>
</form>

<div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
      <div class="card text-center">
          <div class="card-header">
            Daftar Pengguna
          </div>
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Admin</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Karyawan</a>
            </div>
        </nav>
          <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="table-responsive tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <table class="table">
                      <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($admin as $adm)
                            <tr>
                              <th scope="row">{{$adm->id_user}}</th>
                              <td>{{$adm->name}}</td>
                              <td>{{$adm->email}}</td>
                              <td><span class="badge bg-success">Admin</span></td>
                            </tr>
                          @empty
                          <tr>
                            <td colspan="4" class="text-center">Data not available !</td>
                          </tr>
                          @endforelse
                        </tbody>
                  </table>
              </div>
              <div class="table-responsive tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Email</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($karyawan as $kar)
                          <tr>
                            <th scope="row">{{$kar->id_user}}</th>
                            <td>{{$kar->name}}</td>
                            <td>{{$kar->email}}</td>
                            <td><span class="badge bg-warning">karyawan</span></td>
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
</div>
@stop

@section('script')
  <script>    
  </script>
@endSection