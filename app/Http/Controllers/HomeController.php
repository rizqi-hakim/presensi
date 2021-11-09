<?php

namespace App\Http\Controllers;

use App\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;

        $today = Carbon::now()->toDateString();
        $start = date($today.' 00:00:01');
        $end = date($today.' 23:59:59');

        if ($role == 1) {

            $presenceIn = Presence::where(['tipe' => '1'])->whereBetween('presence_date', [$start, $end])->get();
            $presenceOut = Presence::where(['tipe' => '2'])->whereBetween('presence_date', [$start, $end])->get();
            return view('home', compact('presenceIn', 'presenceOut', 'today'));
        } else {

            $presenceIn = Presence::where(['tipe' => '1', 'id_user' => Auth::user()->id_user])->whereBetween('presence_date', [$start, $end])->get();
            $presenceOut = Presence::where(['tipe' => '2', 'id_user' => Auth::user()->id_user])->whereBetween('presence_date', [$start, $end])->get();
            return view('home', compact('presenceIn', 'presenceOut', 'today'));
        }
    }

    
}
