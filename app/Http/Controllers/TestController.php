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


class TestController extends Controller
{

    public function tes(Request $request)
    {
       
        $data = [   'title' => 'Forbidden',
                    'user' =>  Session::get('user_module'),
                    'module' => Session::get('modules'),
                    'content'   => 'global/notification/forbidden'
                ];

    
        return view('layout/wrapper',$data);

    }


   




}
