@extends('layouts.header_footer')

@section('main-section')
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="container overflow-hidden">
    <div class="row gx-5">
      <div class="col">
        <div class="card text-center">
            <div class="card-header">
              Sakit
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Waktu Izin</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Status</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($sakit as $key => $sk)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('d-m-Y', strtotime($sk->permit_date))}}</td>
                                <td>{{$sk->permit_name->name}}</td>
                                @if ($sk->status == 1)
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td><span class="badge bg-info">--</span></td>
                                    @else
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <form method="POST" action="{{url('storeApproval')}}">
                                        @csrf
                                        <input type="hidden" name="id_permit" value="{{$sk->id}}">
                                        <td><button class="btn btn-sm btn-success" type="submit">Approve</button></td>
                                    </form>
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
              Cuti
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Waktu Izin</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($cuti as $key => $ct)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('d-m-Y', strtotime($ct->permit_date))}}</td>
                                <td>{{$ct->permit_name->name}}</td>
                                @if ($ct->status == 1)
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td><span class="badge bg-info">--</span></td>
                                    @else
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <form method="POST" action="{{url('storeApproval')}}">
                                        @csrf
                                        <input type="hidden" name="id_permit" value="{{$ct->id}}">
                                        <td><button class="btn btn-sm btn-success" type="submit">Approve</button></td>
                                    </form>
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