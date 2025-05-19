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
use App\Models\DirectService;


class ServicesController extends Controller
{

    public function directService()
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $dataCounts = DirectService::getCounts();
            $direct = DirectService::getDirectData();
            $bengkel = DirectService::getBengkelData();
        
            $data = [
                'title'         => 'Direct Service',
                'countreq'      => $dataCounts->countreq,
                'countestimate' => $dataCounts->countestimate,
                'direct'        => $direct,
                'bengkel'       => $bengkel,
                'content'       => 'service/direct',
            ];
        
            return view('layout/wrapper',$data);

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


    public function ServiceBengkelProcess($id)
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'BENGKEL') {

            $bengkel 	= DB::connection('mtr')->table('mst.mst_bengkel')->where('pic_bengkel',Session()->get('username'))->first();
            $service = DB::connection('mtr')->table('mvm.v_spk_detail')->where('id',$id)->first();
          
            $part 	= DB::connection('mtr')->table('mst.v_service_item_motor')->where('price_service_type','Part')->where('mst_regional_id',$service->mst_regional_id)->where('mst_client_id',$service->mst_client_id)->get();
            $jobs 	=  DB::connection('mtr')->table('mst.v_service_item_motor')->where('price_service_type','Jasa')->where('mst_regional_id',$service->mst_regional_id)->where('mst_client_id',$service->mst_client_id)->get();
            
            $gps = DB::connection('mtr')->table('mst.mst_vehicle_gps')->where('nopol',$service->nopol)->first();
            $data = array(   'title'     => 'Service '.$service->nopol,
                             'service'      => $service,
                             'part'      => $part,
                             'jobs'      => $jobs,
                             'gps'      => $gps,
                            'content'   => 'service/service_bengkel_proses'
                        );

                        return view('layout/wrapper',$data);
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

    
    public function ServiceListBengkel(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'BENGKEL') {

            $bengkel 	= DB::connection('mtr')->table('mst.mst_bengkel')->where('pic_bengkel',Session()->get('username'))->first();

            $countservice = DB::connection('mtr')->table('mvm.v_spk_detail')->where('spk_status','ONPROGRESS')->wherein('status_service',['ONSCHEDULE'])
                            ->where('mst_bengkel_id',$bengkel->id)
                            ->count();
            $service = DB::connection('mtr')->table('mvm.v_spk_detail')->where('spk_status','ONPROGRESS')
                        ->wherein('status_service',['ONSCHEDULE'])
                        // ->where('mst_bengkel_id',$bengkel->id)
                        ->orderByRaw('tanggal_schedule')->get();
    
            $data = array(   'title'     => 'List Service',
                             'countservice'      => $countservice,
                             'service'      => $service,
                            'content'   => 'service/service_list_bengkel'
                        );
        
            return view('layout/wrapper',$data);

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
    


    public function ServiceListpublic(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'BENGKEL' || $role === 'ADMIN TS3') {

            $bengkel 	= DB::connection('mtr')->table('mst.mst_bengkel')->where('pic_bengkel',Session()->get('username'))->first();

            $countservice = DB::connection('mtr')->table('mvm.v_spk_detail')->where('spk_status','ONPROGRESS')->wherein('status_service',['ONSCHEDULE'])
                            ->where('mst_bengkel_id',$bengkel->id)
                            ->count();
            $service = DB::connection('mtr')->table('mvm.v_spk_detail')->where('spk_status','ONPROGRESS')
                        ->wherein('status_service',['ONSCHEDULE'])
                        // ->where('mst_bengkel_id',$bengkel->id)
                        ->orderByRaw('tanggal_schedule')->get();
    
            $data = array(   'title'     => 'List Service',
                             'countservice'      => $countservice,
                             'service'      => $service,
                            'content'   => 'service/service_list_public'
                        );
        
            return view('layout/wrapper',$data);

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


   




}