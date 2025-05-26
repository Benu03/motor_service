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


class B2CController extends Controller
{

    public function ServiceListpublic(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;

        if ($role === 'BENGKEL' || $role === 'ADMIN TS3') {
            $count = DB::connection('mtr')
            ->table('mvm.mvm_service_user_h')
            ->select('status', DB::raw('count(status) as count_status'))
            ->groupBy('status')
            ->get();

            $dataList = DB::connection('mtr')
                ->table('mvm.mvm_service_user_h')
                ->get();

            $data = [
                'title'   => 'Service List',
                'count'   => $count,
                'data'    => $dataList,
                'content' => 'b2c/service_list',
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

    public function ServiceDetailB2C(Request $request)
    {   
        $id = $request->input('id');
        Log::info('ServiceDetailB2C request ID: ' . $id);
    
        $datadetail = DB::select("
            SELECT 
                a.unique_data,
                CASE 
                    WHEN a.detail_type = 'Spare Part' THEN 'PARTS'
                    WHEN a.detail_type = 'Pekerjaan' THEN 'JASA'
                END AS tipe,
                a.value_data AS nama,
                a.qty AS jumlah,
                b.price_ts3_to_client as biaya,
                b.service_name,
                a.remark_adjustment AS keterangan
            FROM 
                mvm.mvm_service_user_d a
            LEFT JOIN 
                mst.mst_price_service b 
            ON 
                a.unique_data::BIGINT = b.id 
            WHERE 
                a.mvm_service_user_h_id = ?
            AND 
                a.detail_type IN ('Pekerjaan', 'Spare Part')
        ", [$id]);
    
        return response()->json($datadetail);
    }
    

    public function Ordereb2c(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;

        if ($role === 'BENGKEL' || $role === 'ADMIN TS3') {
            $count = DB::connection('mtr')
            ->table('mvm.mvm_service_direct_staging')
            ->select('status', DB::raw('count(status) as count_status'))
            ->groupBy('status')
            ->get();

            $dataList = DB::connection('mtr')
                ->table('mvm.mvm_service_direct_staging')
                ->get();

            $data = [
                'title'   => 'Order List',
                'count'   => $count,
                'data'    => $dataList,
                'content' => 'b2c/order_list',
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


    public function invoiceb2c(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;

        if ($role === 'BENGKEL' || $role === 'ADMIN TS3') {
        
            $data = [
                'title'         => 'Invoice List',
                'content'       => 'b2c/invoice_list',
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



   




}