@extends('layouts.header_footer')

@section('main-section')
    <h3>
        <center>Report Kehadiran</center>
    </h3>
    <h5>
        <center>{{date("j F Y",strtotime($source))."  -  ".date("j F Y",strtotime($source2))}} </center>
    </h5>

    <h5>USER : {{$user_id}}</h5>
    <table width="100%" class="table-bordered" id="myTable" style="margin-top: 5px; clear: both;">
        <thead>
            <tr style="border-collapse: separate; border: 2px solid #ddd;">
                {{-- <th class="text-center border-bold border-bottom-bold">No</th> --}}
                <th class="text-center border-bold border-bottom-bold">Tanggal</th>
                <th class="text-center border-bold border-bottom-bold">Tipe</th>
                <th class="text-center border-bold border-bottom-bold">Waktu</th>
                <th class="text-center border-bold border-bottom-bold">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($header as $key => $data)
            <tr>
                {{-- <td class="text-center">{{$key+1}}</td> --}}
                {{-- <td class="text-center">{{date('d-m-Y H:i:s', strtotime($data->presence_date))}}</td> --}}
                <td class="text-center">{{date('d-m-Y', strtotime($data->presence_date))}}</td>
                {{-- <td class="text-center">{{$data->tipe}}</td> --}}
                @if ($data->tipe == 1)
                    <td class="text-center"><span class="badge bg-primary">Masuk</span></td>
                @elseif ($data->tipe == 2)
                    <td class="text-center"><span class="badge bg-info">Pulang</span></td>
                @elseif ($data->tipe == 3)
                    <td class="text-center"><span class="badge bg-light text-dark">Sakit</span></td>
                @else
                    <td class="text-center"><span class="badge bg-dark">Cuti</span></td>
                @endif
                <td class="text-center">{{date('H:i:s', strtotime($data->presence_date))}}</td>
                @if ($data->status == 1)
                    <td class="text-center"><span class="badge bg-success">Valid</span></td>
                @else
                    <td class="text-center"><span class="badge bg-warning">Tidak Valid</span></td>
                @endif
            </tr>
            @empty
                <td colspan="4" class="text-center">Data not available !</td>
            @endforelse
        </tbody>
    </table>
    {{-- <table class="table-bordered" id="myTable">
        <tr>
            <td>2021-01-01 00:00:10</td>
            <td>1</td>
        </tr>
        <tr>
            <td>2021-01-01 00:00:10</td>
            <td>2</td>
        </tr>
        <tr>
            <td>b</td>
            <td>1</td>
        </tr>
        <tr>
            <td>c</td>
            <td>1</td>
        </tr>  
        <tr>
            <td>c</td>
            <td>1</td>
        </tr>
    </table> --}}
@stop

@section('script')
<script>
    $(document).ready(function() {
       var span = 1;
       var prevTD = "";
       var prevTDVal = "";
       $("#myTable tr td:first-child").each(function() { //for each first td in every tr
          var $this = $(this);
          if ($this.text() == prevTDVal) { // check value of previous td text
             span++;
             if (prevTD != "") {
                prevTD.attr("rowspan", span); // add attribute to previous td
                $this.remove(); // remove current td
             }
          } else {
             prevTD     = $this; // store current td 
             prevTDVal  = $this.text();
             span       = 1;
          }
       });
    });
</script>
@endsection