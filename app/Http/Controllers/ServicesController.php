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


    public function directServiceProcess(Request $request)
    {

    }
    


   




}
