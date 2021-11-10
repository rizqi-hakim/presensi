<?php

namespace App\Http\Controllers;

use App\Presence;
use App\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function indexReport()
    {
        $source = date('01-m-Y');
        $source2 = date('d-m-Y');
        $type = "";
        $users = User::where('role', '0')->get();

        $dataView = [
            'source' => $source,
            'source2' => $source2,
            'type' => $type,
            'users' => $users
        ];

        return view('report.reportList', $dataView);
    }

    public function Search(Request $request)
    {
        Log::info("REPORT REQUEST > " . json_encode($request->all()));

        if ($request->reportname == 1) { // Kehadiran
            if ($request->type_value == 1) { //VIEW
                return self::ViewReportPresent($request);
            } else if ($request->type_value == 2) { //Excel
                return self::ReportPresentExcel($request);
            }
        } else if ($request->reportname == 2) { // Ketidakhadiran
            if ($request->type_value == 1) { //VIEW
                return self::ViewReportAbsent($request);
            } else if ($request->type_value == 2) { //Excel
                // return self::ReportAbsentExcel($request);
            }
        }
    }

    public function ViewReportPresent(Request $request)
    {
        $source = $request->tgl1;
        $source2 = $request->tgl2;
        $type = $request->type_value;
        $user_id = $request->idKaryawan;

        $header = self::getQueryReport($request);
        return View("report.presentReport", compact('header', 'source', 'source2', 'type', 'user_id'));
    }

    public function ReportPresentExcel(Request $request)
    {
        $source = $request->tgl1;
        $source2 = $request->tgl2;
        $type = $request->type_value;
        $user_id = $request->idKaryawan;

        $header = self::getQueryReport($request);
        $page = "Report Kehadiran";
        
        // Excel::create($page, function ($excel) use ($header, $source, $source2, $user_id, $page) {
        //     $excel->sheet($page, function ($sheet) use ($header, $source, $source2, $user_id, $page) {
        //         $sheet->loadView('report.presentReportExcel', [
        //             'page' => $page,
        //             'source' => $source,
        //             'source2' => $source2,
        //             'header' => $header,
        //             'user_id' => $user_id
        //         ]);
        //     });
        // })->download();
    }

    public function ViewReportAbsent(Request $request)
    {
        $source = $request->tgl1;
        $source2 = $request->tgl2;
        $type = $request->type_value;
        $user_id = $request->idKaryawan;

        //get all day from date range
        $periode_arr = [];
        $begin = new DateTime(date('Y-m-d', strtotime($source)));
        $end = new DateTime(date('Y-m-d', strtotime($source2)));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        foreach ($period as $dt) {
            array_push($periode_arr, $dt->format('j F Y'));
        }

        //get all day from presences
        $header = self::getQueryReport($request);
        $present_arr = [];
        foreach ($header as $h) {
            array_push($present_arr, date('j F Y',strtotime($h->presence_date)));
        }

        //diff array
        $result = array_diff($periode_arr,$present_arr);

        return View("report.absentReport", compact('result', 'source', 'source2', 'type', 'user_id'));
    }

    public function getQueryReport(Request $request)
    {
        try {
            Log::info('Request get report present = ' . json_encode($request->all()));
            Log::info('Start');

            $source = $request->tgl1;
            $date = new DateTime($source);
            $tglmulai = $date->format('Y-m-d');
    
            $source2 = $request->tgl2;
            $date2 = new DateTime($source2);
            $tglakhir = $date2->format('Y-m-d');
    
            $startDate = $tglmulai . " 00:00:00";
            $endDate = $tglakhir . " 23:59:59";
            $dateRange = array($startDate, $endDate);
            Log::info('Periode report present  = ' . json_encode($dateRange));

            $present = Presence::whereBetween('presence_date', $dateRange)
                ->where('id_user', $request->idKaryawan)
                ->orderBy('presence_date', 'ASC')
                ->get();
            
            return $present;
        
        } catch (\Exception $exception) {
            Log::error('ERROR::report present = ' . $exception->getMessage());
            Log::error('ERROR::report present = ' . $exception->getLine());
            Log::error('ERROR::report present = ' . $exception->getFile());
            Log::error('ERROR::report present = ' . $exception->getTraceAsString());
            return array();
        }
    }

    
}
