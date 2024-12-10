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


class MasterController extends Controller
{

    public function Bengkel(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $user_bengkel 	= DB::connection('sso')->table('auth.v_auth_user_module')
                                ->where('module','MOTOR SERVICE')
                                ->where('role','BENGKEL')
                                ->get();

            $data = array(  'title'     => 'Bengkel',
                            'userbengkel'      => $user_bengkel,
                            'content'   => 'master/admints3/bengkel'
                        );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function PriceService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client = DB::connection('mtr')->table('mst.mst_client')->where('client_type', 'B2B')->get();
            $regional = DB::connection('mtr')->table('mst.mst_regional')->get();
            $kode_max = DB::connection('mtr')->table('mst.v_price_service')
                ->selectRaw("concat('TS3-', max(substring(kode from 5 for 5)::int + 1)) as kode")
                ->first();
            $price_type = DB::connection('mtr')->table('mst.mst_general')->where('name', 'price_service_type')->get();
    
      
            $data = compact('client', 'regional', 'kode_max', 'price_type');
            $data['title'] = 'Price Service';
            $data['content'] = 'master/admints3/price_service';
    
            return view('layout/wrapper', $data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function Regional(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $regional 	= DB::connection('mtr')->table('mst.v_regional')->get();
        $client 	= DB::connection('mtr')->table('mst.mst_client')->where('client_type','B2B')->get();

		$data = array(  'title'     => 'Regional',
                        'regional'      => $regional,
                        'client'      => $client,
                        'content'   => 'master/admints3/regional'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }



    
    public function Area(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $regional 	= DB::connection('mtr')->table('mst.v_regional')->get();

            $data = array(  'title'     => 'Area',
                            'regional'      => $regional,
                        'content'   => 'master/admints3/area'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function Branch(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client 	= DB::connection('mtr')->table('mst.v_client_product')->where('client_type','B2B')->get();

            $data = array(  'title'     => 'Branch',
                             'client'      => $client,
                        'content'   => 'master/admints3/branch'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function Vehicle(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client 	= DB::connection('mtr')->table('mst.mst_client')->where('client_type','B2B')->get();
        $vehicle_type 	= DB::connection('mtr')->table('mst.mst_vehicle_type')->get();

		$data = array(  'title'     => 'Vehicle',
                        'vehicle_type'      => $vehicle_type,
                        'client'      => $client,
                        'content'   => 'master/admints3/vehicle'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function VehicleType(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $group_vehicle 	= DB::connection('mtr')->table('mst.mst_general')->where('name','Group Vehicle')->where('value_1','Motor')->get();

            $data = array(  'title'     => 'Vehicle Type',
                    
                            'group_vehicle'      => $group_vehicle,
                    
                        'content'   => 'master/admints3/vehicle_type'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    

    
   




}
