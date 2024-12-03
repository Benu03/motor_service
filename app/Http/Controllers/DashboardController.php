<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Libraries\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;

        if ($role === 'ADMIN TS3') {
            return $this->dashAdminTs3();
        } 
        else 
        {
            $data = [
                'title' => 'Access Forbidden',
                'content' => 'global/notification/forbidden',
            ];

            return view('layout/wrapper', $data);
        }
    }

    private function dashAdminTs3()
    {
        $vehicle = DB::connection('mtr')->table('mst.mst_vehicle')->count();
        $rating = DB::connection('mtr')->table('mvm.v_rating_mvm')->get();
        $motor = DB::connection('mtr')->table('mst.v_chart_vehicle_motor')->get();
    
        $dataPointsrating = $rating->map(function ($item) {
            return [
                "name" => $item->rating,
                "y" => $item->total
            ];
        });
    
        $dataPointsmotor = $motor->map(function ($item) {
            return [
                "name" => $item->client_name,
                "y" => $item->total
            ];
        });
    
        $data = [
            'title' => 'Dashboard',
            'vehicle' => $vehicle,
            'dataPointsrating' => $dataPointsrating->toJson(),
            'dataPointsmotor' => $dataPointsmotor,
            'content' => 'dashboard/admin_ts3',
        ];
    
        return view('layout/wrapper', $data);
    }
    




}
