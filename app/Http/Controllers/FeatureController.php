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


class FeatureController extends Controller
{

    public function VehicleCheck(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $data = array(   'title'     => 'Vehicle Check',
                      
                        'content'   => 'feature/admints3/vehicle_check'
                    );
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function GpsCheck(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $data = array(   'title'     => 'GPS Check',
                      
                            'content'   => 'feature/admints3/gps_check'
                        );
                return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


   




}
