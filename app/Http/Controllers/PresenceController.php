<?php

namespace App\Http\Controllers;

use App\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function store(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $start = strtotime($today.' 09:00:00');
        $end = strtotime($today.' 17:00:00');

        $now = strtotime(Carbon::now()->toDateTimeString());

        //check presence status
        if ($request->tipe == '1') {
            if ($now < $start) {
                $cekStatus = '1';
            } else {
                $cekStatus = '0';
            }
        } else {
            if ($now > $end) {
                $cekStatus = '1';
            } else {
                $cekStatus = '0';
            }
        }
        
        // store into presences
        Presence::create([
            'id_user' => $request->idKaryawan,
            'tipe' => $request->tipe,
            'status' => $cekStatus,
            'presence_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route('home'))->with(['success' => 'Presensi ' . $request->idKaryawan . ' Sukses!']);
    }
}
