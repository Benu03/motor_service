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
    
    public function SpkListService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
            $countspk = DB::connection('mtr')->table('mvm.v_spk_detail')
                ->select(
                    DB::raw("COUNT(CASE WHEN status_service = 'PLANING' THEN 1 END) as countspkplan"),
                    DB::raw("COUNT(CASE WHEN status_service = 'ONSCHEDULE' THEN 1 END) as countspkonchecldule"),
                    DB::raw("COUNT(CASE WHEN status_service = 'SERVICE' THEN 1 END) as countspkservice")
                )
                ->where('spk_status', 'ONPROGRESS')
                ->first();
    
            $data = [
                'title' => 'SPK List Service',
                'countspkplan' => $countspk->countspkplan ?? 0,
                'countspkonchecldule' => $countspk->countspkonchecldule ?? 0,
                'countspkservice' => $countspk->countspkservice ?? 0,
                'bengkel' => DB::connection('mtr')->table('mst.v_bengkel')->get(),
                'spkonprogress' => DB::connection('mtr')->table('mvm.mvm_spk_h')
                    ->where('status', 'ONPROGRESS')
                    ->orderBy('id', 'desc')
                    ->get(),
                'nopol' => DB::connection('mtr')->table('mst.mst_vehicle')->get(),
                'cabang' => DB::connection('mtr')->table('mst.v_branch_client')->get(),
                'content' => 'spk/admints3/spk_list'
            ];
    
            return view('layout/wrapper', $data);
        }
    
        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);
    }
    
    public function GetSpkListService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
            $spkList = DB::connection('mtr')->table('mvm.v_spk_detail')->get();
            return response()->json($spkList);
        }
    
        return response()->json([
            'error' => 'Access forbidden'
        ], 403);
    }
    
    public function GetSpkListServiceDetail(Request $request, $id)
    {
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
            $spkService = DB::connection('mtr')->table('mvm.v_spk_detail')
                ->where('id', $id)
                ->orderBy('tanggal_schedule')
                ->first();
    
            return response()->json($spkService);
        }
    
        return response()->json([
            'error' => 'Access forbidden'
        ], 403);
    }
    
    public function SpkServiceProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
            if (empty($request->id)) {
                return redirect('spk-list-service')->with([
                    'error' => 'Data tidak ada yang dipilih.'
                ]);
            }
    
            $ids = $request->id;
            foreach ($ids as $id) {
                DB::connection('mtr')->table('mvm.mvm_spk_d')
                    ->where('id', $id)
                    ->update([
                        'remark_ts3' => $request->remark,
                        'tanggal_schedule' => $request->tanggal_schedule,
                        'mst_bengkel_id' => $request->mst_bengkel_id,
                        'status_service' => 'ONSCHEDULE'
                    ]);
            }
    
            return redirect('admin-ts3/spk-list')->with([
                'success' => 'Data telah diproses.'
            ]);
        }
    
        return response()->json([
            'error' => 'Access forbidden'
        ], 403);
    }
    


   




}
