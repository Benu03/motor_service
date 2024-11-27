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


class MainController extends Controller
{

    public function profile(Request $request)
    {
            

        $data = [   'title' => 'Dashboard',
                    'user' =>  Session::get('user_module'),
                    'module' => Session::get('modules'),
                    'content'   => 'dasboard/bengkel'
                ];

    
        return view('layout/wrapper',$data);


  
    }

    
    public function logout(Request $request)
    {
            

        $data = [   'title' => 'Dashboard',
                    'user' =>  Session::get('user_module'),
                    'module' => Session::get('modules'),
                    'content'   => 'dasboard/bengkel'
                ];

    
        return view('layout/wrapper',$data);


  
    }


   




}
