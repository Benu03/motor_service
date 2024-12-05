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


class SPKController extends Controller
{

    public function index(Request $request)
    {
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function SpkStatus(Request $request)
    {
     
        $role = Session::get('modules')['role'] ?? null;

        if ($role === 'ADMIN TS3') {
    
            $spkData = DB::connection('mtr')
                ->table('mvm.mvm_spk_h')
                ->selectRaw("
                   COUNT(CASE WHEN status = 'WAITING' THEN 1 END) as waiting,
                    COUNT(CASE WHEN status = 'ONPROGRESS' THEN 1 END) as onprogress,
                    JSON_AGG(ROW_TO_JSON(mvm_spk_h)) as spk
                ")
                ->first();

            $data = [
                'title' => 'SPK Status',
                'waiting' => $spkData->waiting ?? 0,
                'onprogress' => $spkData->onprogress ?? 0,
                'spk' => json_decode($spkData->spk) ?? [],
                'content' => 'spk/admints3/spk_status',
            ];

            return view('layout/wrapper', $data);
        }

        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);
    }



    public function SpkProcess(Request $request)
    {
       
    
            $validatedData = $request->validate([
                'tanggal_proses' => 'required',
                'remark'         => 'required',
            ]);
    
            try {

                DB::connection('mtr')->transaction(function () use ($request, $validatedData) {
                    DB::connection('mtr')
                        ->table('mvm.mvm_spk_h')
                        ->where('spk_seq', $request->spk_seq)
                        ->update([
                            'remark'      => $validatedData['remark'],
                            'status'      => 'ONPROGRESS',
                            'user_proses' => session()->get('user_module')['username'] ?? 'unknown',
                            'proses_date' => $validatedData['tanggal_proses'],
                        ]);
                });
        
                return redirect('spk-status')->with(['sukses' => 'Data berhasil diproses']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => 'Terjadi kesalahan ']);
            }
    }
    


    
   




}
