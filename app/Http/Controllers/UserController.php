<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 1)->get();
        $karyawan = User::where('role', 0)->get();
        
        return view('user', compact('admin', 'karyawan'));
    }

    public function store(Request $request)
    {
        $year_now = Carbon::now()->format('Y');
        $latest_record = User::where('role', $request->role)->where('id_user', 'like', '%'.$year_now.'%')->orderBy('id','desc')->first();

        $custom_mark_id = $request->role == 1 ? 'ADM' : 'USR';
        if (!empty($latest_record)) {
            $latest_id_user = $latest_record->id_user;
            $increment = (int)substr($latest_id_user , -4)+1;
            $id_user = $custom_mark_id. '-' .$year_now .str_pad($increment,4,"0",STR_PAD_LEFT);
        } else {
            $id_user = $custom_mark_id. '-' .$year_now .'0000';
        }

        User::create([
            'id_user' => $id_user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect(route('user'))->with(['success' => 'Data pengguna berhasil ditambahkan!']);
    }
}
