<?php

namespace App\Http\Controllers;

use App\Permit;
use App\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermitController extends Controller
{
    public function indexSakit()
    {
        $sakit = Permit::where(['permit_type' => 'sakit', 'id_user' => Auth::user()->id_user])->orderBy('permit_date', 'DESC')->get();

        return view('izin.sakit', compact('sakit'));
    }

    public function storeSakit(Request $request)
    {
        Permit::create([
            'id_user' => $request->idKaryawan,
            'permit_date' => $request->permit_date,
            'permit_type' => 'sakit',
            'status' => '0',
        ]);

        return redirect(route('sakit'))->with(['success' => 'Permohonan izin telah terkirim!']);
    }

    public function indexCuti()
    {
        $cuti = Permit::where(['permit_type' => 'cuti', 'id_user' => Auth::user()->id_user])->orderBy('permit_date', 'DESC')->get();

        return view('izin.cuti', compact('cuti'));
    }

    public function storeCuti(Request $request)
    {
        Permit::create([
            'id_user' => $request->idKaryawan,
            'permit_date' => $request->permit_date,
            'permit_type' => 'cuti',
            'status' => '0',
        ]);

        return redirect(route('cuti'))->with(['success' => 'Permohonan izin telah terkirim!']);
    }

    public function approval()
    {
        $sakit = Permit::where(['permit_type' => 'sakit'])->orderBy('permit_date', 'ASC')->get();
        $cuti = Permit::where(['permit_type' => 'cuti'])->orderBy('permit_date', 'ASC')->get();

        return view('izin.approval', compact('sakit', 'cuti'));
    }

    public function storeApproval(Request $request)
    {
        DB::beginTransaction();

        try {
            $id_permit = $request->id_permit;
            $find_permit = Permit::find($id_permit);

            $find_permit->update(['status' => 1]);

            Presence::create([
                'id_user' => $find_permit->id_user,
                'status' => '1',
                'tipe' => $find_permit->permit_type == 'sakit' ? '3' : '4',
                'presence_date' => $find_permit->permit_date,
            ]);
            DB::commit();
            return redirect(route('approval'))->with(['success' => 'Sukses approve!']);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('approval'))->with(['error' => 'Error approve!']);
        }

    }

}
