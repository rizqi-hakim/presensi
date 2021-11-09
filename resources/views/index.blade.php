@extends('layouts.header_footer')

@section('main-section')
<div class="card text-center mb-3">
    <div class="card-header">
      Presensi
    </div>
    <div class="card-body">
      <h5 class="card-title">Masukkan ID Karyawan Anda</h5>
      <p class="card-text">Pilih tipe presensi (Masuk/Pulang)</p>
      <div class="container overflow-hidden">
        <div class="row gx-5">
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">ID Karyawan</label>
            <input type="text" class="form-control" id="idKaryawan">
            <div class="form-text">Pastikan menginput dengan benar</div>
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Tipe Presensi</label>
            <select class="form-select">
                <option selected>Pilih tipe</option>
                <option value="1">Masuk</option>
                <option value="2">Pulang</option>
              </select>
            <div class="form-text">Pastikan menginput dengan benar</div>
          </div>
        </div>
      </div>
      <a href="#" class="btn btn-primary">Presensi Sekarang</a>
    </div>
    <div class="card-footer text-muted">
      2 days ago
    </div>
  </div>

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
                            <tr>
                              <th scope="row">1</th>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td><span class="badge bg-success">Success</span></td>
                            </tr>
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
                            <tr>
                              <th scope="row">1</th>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td><span class="badge bg-danger">Danger</span></td>
                            </tr>
                          </tbody>
                    </table>
                  </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@stop