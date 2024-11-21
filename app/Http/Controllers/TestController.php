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
       
        $data['module'] = Session::get('modules');
        $data['user'] = Session::get('user_module');


        return view('dummy.index', $data);
    }


   




}
