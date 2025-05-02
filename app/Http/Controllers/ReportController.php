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
use DataTables;


class ReportController extends Controller
{

    public function ReportHistoryService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {

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

    public function ReportHistoryServiceDetail($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {


            $ar = DB::connection('mtr')->table('mvm.v_service_history')->where('service_no', $id)->first();

            $data = array(   'title'     => 'History Service '.$ar->service_no,
                             'ar'      => $ar,
                            'content'   => 'report/admints3/service_detail_history'
                        );

            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

     
    public function exportHistoryService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {


            if ($request->ajax()) {
                $query = DB::connection('mtr')->table('mvm.v_service_history')->selectRaw("
                    spk_no, service_no, nopol, norangka, nomesin, tahun, 
                    type as tipe, status_service, tanggal_service, 
                    nama_driver, last_km, bengkel_name as bengkel, mekanik,
                    tgl_last_service, regional, area, branch as cabang, pic_branch as pic_cabang, 
                    tanggal_schedule, remark_ts3 as remark
                ");
        
                if (!empty($request->from_date) && !empty($request->to_date)) {
                    $query->whereBetween('tanggal_service', [$request->from_date, $request->to_date]);
                }
        
                if (!empty($request->spkno)) {
                    $query->where('spk_no', 'ILIKE', '%' . $request->spkno . '%');
                }
        
                $service = $query->get();
        
                return response()->json(['data' => $service]);
            }

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    

    

    public function getHistoryService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {

            if ($request->ajax()) {
                $query = DB::connection('mtr')->table('mvm.v_service_history');
        
                if (!empty($request->from_date) && !empty($request->to_date)) {
                    $query->whereBetween('tanggal_service', [$request->from_date, $request->to_date]);
                }
        
                if (!empty($request->spkno)) {
                    $query->where('spk_no', 'ILIKE', '%' . $request->spkno . '%');
                }
        
                $service = $query->get();
        
                return DataTables::of($service)
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . asset('history-service-detail/' . $row->service_no) . '" 
                            class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

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
        if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {


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
    

    public function GetRekapInvoice(Request $request)
{
    $role = Session::get('modules')['role'] ?? null;

    if ($role === 'ADMIN TS3' || $role === 'BENGKEL') {
        if ($request->ajax()) {
            if (!empty($request->from_date)) {
                $invoiceList = DB::connection('mtr')->table('mvm.v_rekap_invoice')
                    ->whereBetween('created_date', [$request->from_date, $request->to_date])
                    ->where('invoice_type', 'BENGKEL TO TS3')
                    ->get();
            } else {
                $invoiceList = DB::connection('mtr')->table('mvm.v_rekap_invoice')
                    ->where('invoice_type', 'BENGKEL TO TS3')
                    ->get();
            }

            return DataTables::of($invoiceList)->addColumn('action', function ($row) {
                $btn = '<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rkapInvoice' . $row->id . '">
                            <i class="fa fa-eye"></i>
                        </a>';

                $modal = '
                <div class="modal fade" id="rkapInvoice' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Invoice ' . $row->invoice_no . '</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">Invoice Data</div>
                                            <div class="card-body">
                                                <div class="table-responsive-md">
                                                    <table class="table table-bordered" style="font-size: 12px;">
                                                        <thead>
                                                            <tr class="bg-secondary">
                                                                <th width="15%">Invoice Nomor</th>
                                                                <th width="15%">Tanggal Invoice</th>
                                                                <th width="10%">Regional</th>
                                                                <th width="10%">Status</th>
                                                                <th width="10%">PPH</th>
                                                                <th width="10%">Jasa</th>
                                                                <th width="10%">Part</th>
                                                                <th width="10%">Total</th>
                                                                <th width="10%">User Request</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>' . $row->invoice_no . '</td>
                                                                <td>' . $row->created_date . '</td>
                                                                <td>' . $row->regional . '</td>
                                                                <td>' . $row->status . '</td>
                                                                <td>' . "Rp " . number_format($row->pph, 0, ',', '.') . '</td>
                                                                <td>' . "Rp " . number_format($row->jasa_total, 0, ',', '.') . '</td>
                                                                <td>' . "Rp " . number_format($row->part_total, 0, ',', '.') . '</td>
                                                                <td>' . "Rp " . number_format(($row->jasa_total - $row->pph) + $row->part_total, 0, ',', '.') . '</td>
                                                                <td>' . $row->create_by . '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <div class="card">
                                            <div class="card-header">Invoice Detail</div>
                                            <div class="card-body">
                                                <div class="table-responsive-md">
                                                    <table class="table table-bordered table-sm" style="font-size: 11px;">
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th width="14%">SERVICE NO</th>
                                                                <th width="8%">JASA</th>
                                                                <th width="8%">PART</th>
                                                                <th width="8%">NOPOL</th>
                                                                <th width="10%">Area</th>
                                                                <th width="15%">CABANG</th>
                                                                <th width="17%">TIPE</th>
                                                                <th width="10%">Tanggal Service</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';

                $invoicedetail = DB::connection('mtr')->table('mvm.v_invoice_detail')->where('invoice_no', $row->invoice_no)->get();

                foreach ($invoicedetail as $ind) {
                    $modal .= '
                        <tr>
                            <td>' . $ind->service_no . '</td>
                            <td>' . "Rp " . number_format($ind->jasa, 0, ',', '.') . '</td>
                            <td>' . "Rp " . number_format($ind->part, 0, ',', '.') . '</td>
                            <td>' . $ind->nopol . '</td>
                            <td>' . $ind->area . '</td>
                            <td>' . $ind->branch . '</td>
                            <td>' . $ind->type . '</td>
                            <td>' . $ind->tanggal_service . '</td>
                        </tr>';
                }

                $modal .= '
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="' . asset("bengkel/invoice-generate/{$row->invoice_no}") . '" class="btn btn-secondary">
                                            <i class="far fa-file-excel"></i> Generate Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

                return $btn . $modal;
            })->rawColumns(['action'])->make(true);
        }
    }

    // Jika bukan ADMIN TS3 atau BENGKEL
    $data = [
        'title' => 'Access Forbidden',
        'content' => 'global/notification/forbidden'
    ];

    return view('layout/wrapper', $data);
}






   




}