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


class ReportController extends Controller
{

    public function ReportHistoryService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $data = [   'title'     => 'History Service',
                        'content'   => 'report/admints3/history_service'
                ];
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function ReportRealisasiSpk(Request $request)
    {

       
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {


            $regional 	= DB::connection('mtr')->table('mst.v_regional')->get();

            $data = [       'title'     => 'Realisasi SPK',
                            'regional'      => $regional,
                            'content'   => 'report/admints3/realisasi_spk'
                        ];

            return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function ReportRekapInvoice(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {


            $data = array(   'title'     => 'Rekapitulasi Invoice',
                            'content'   => 'report/admints3/rekap_invoice'
                        );

                        return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
    }


    public function ReportSpkHistory(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {


            $data = array(   'title'     => 'SPK History',
                            'content'   => 'report/admints3/spk_history'
                        );
                        return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function ReportSummaryBengkel(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            
            $data = array(   'title'     => 'Summary Bengkel',
                            'content'   => 'report/admints3/summary_bengkel'
                        );
                        return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function ReportServicedueDate(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            
            $data = array(   'title'     => 'Due Date Service',
                            'content'   => 'report/admints3/due_date_service'
                        );
                        return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function ReportLabaRugi(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            
            $laba_rugi = DB::connection('mtr')->table('mvm.v_chart_report_laba_rugi_series')
            ->whereNotNull('type1')
            ->whereNotNull('type2')
            ->get();


                    $dataPointslaba_rugi = [];

                    foreach ($laba_rugi as $lrp) {            
                        $dataPointslaba_rugi[] = [
                            "spk_no" => $lrp->spk_no,
                            "type1" => $lrp->type1,
                            "type2" => $lrp->type2,
                            "total1" => $lrp->total1,
                            "total2" => $lrp->total2               

                        ];
                    }


                    $data = array(   'title'     => 'Laba Rugi',
                                    'laba_rugi'      => $laba_rugi,
                                    'dataPointslaba_rugi' => $dataPointslaba_rugi,
                                    'content'   => 'report/admints3/laba_rugi'
                                );
                                return view('layout/wrapper',$data);
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }
    





   




}
