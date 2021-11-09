@extends('layouts.header_footer')

@section('main-section')
    <h3>
        <center>Report Ketidakhadiran</center>
    </h3>
    <h5>
        <center>{{date("j F Y",strtotime($source))."  -  ".date("j F Y",strtotime($source2))}} </center>
    </h5>

    <h5>USER : {{$user_id}}</h5>
    <table width="100%" class="table-bordered" id="myTable" style="margin-top: 5px; clear: both;">
        <thead>
            <tr style="border-collapse: separate; border: 2px solid #ddd;">
                {{-- <th class="text-center border-bold border-bottom-bold">No</th> --}}
                {{-- <th class="text-center border-bold border-bottom-bold">Tanggal</th> --}}
                <th class="text-center border-bold border-bottom-bold">Tanggal</th>
                <th class="text-center border-bold border-bottom-bold">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($result as $r)
            <tr>
                <td class="text-center">{{$r}}</td>
                <td class="text-center"><span class="badge bg-danger">Absen</span></td>
            </tr>
            @empty
                <td colspan="4" class="text-center">Data not available !</td>
            @endforelse
        </tbody>
    </table>
@stop