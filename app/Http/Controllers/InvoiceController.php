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


class InvoiceController extends Controller
{

    public function InvoiceBengkel(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
                $mvmInvoiceH = DB::connection('mtr')->table('mvm.mvm_invoice_h');
        
     
                $countInvoiceBengkel = $mvmInvoiceH->where('status', 'REQUEST')
                                                ->where('invoice_type', 'BENGKEL TO TS3')
                                                ->count();

                $countInvoiceTS3 = $mvmInvoiceH->where('status', 'PROSES')
                                            ->where('invoice_type', 'BENGKEL TO TS3')
                                            ->count();
                                            
                $invoices = DB::connection('mtr')->table('mvm.v_invoice_admin_ts3')
                    ->whereIn('status', ['PROSES', 'REQUEST'])
                    ->where('invoice_type', 'BENGKEL TO TS3')
                    ->get();


                $data = [
                    'title' => 'Invoice Bengkel',
                    'invoice' => $invoices,
                    'countinvoicebengkel' => $countInvoiceBengkel,
                    'countinvoicets3' => $countInvoiceTS3,
                    'content' => 'invoice/admints3/index',
                ];
            return view('layout/wrapper',$data);
        }
    
        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);

    }
    
    public function InvoiceClient(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {
              
            $username = Session::get('user_module')['username'] ?? null;
            $countInvoiceDraft = DB::connection('mtr')
                ->table('mvm.mvm_invoice_h')
                ->where('status', 'DRAFT')
                ->where('create_by', $username)
                ->where('invoice_type', 'TS3 TO CLIENT')
                ->count();
    
            if ($countInvoiceDraft == 1) {
                return redirect('invoice-client-create');
            }

            $mvmInvoiceH = DB::connection('mtr')->table('mvm.mvm_invoice_h');
            $countInvoiceProses = $mvmInvoiceH->where('status', 'PROSES')
                                              ->where('invoice_type', 'TS3 TO CLIENT')
                                              ->count();
    
            $countInvoiceRequest = $mvmInvoiceH->where('status', 'REQUEST')
                                               ->where('invoice_type', 'TS3 TO CLIENT')
                                               ->count();


            $invoices = DB::connection('mtr')
                ->table('mvm.v_invoice_admin_ts3')
                ->whereIn('status', ['PROSES', 'REQUEST'])
                ->where('invoice_type', 'TS3 TO CLIENT')
                ->get();

            $data = [
                'title' => 'Invoice To Client',
                'invoice' => $invoices,
                'countinvoicets3pro' => $countInvoiceProses,
                'countinvoicets3req' => $countInvoiceRequest,
                'content' => 'invoice/admints3/invoice_client',
            ];
    
            return view('layout/wrapper',$data);
        }
    
        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);

    }

    private function getRomawi($bln)
    {   
        switch ($bln){

                        case 1:

                            return "I";

                            break;

                        case 2:

                            return "II";

                            break;

                        case 3:

                            return "III";

                            break;

                        case 4:

                            return "IV";

                            break;

                        case 5:

                            return "V";

                            break;

                        case 6:

                            return "VI";

                            break;

                        case 7:

                            return "VII";

                            break;

                        case 8:

                            return "VIII";

                            break;

                        case 9:

                            return "IX";

                            break;

                        case 10:

                            return "X";

                            break;

                        case 11:

                            return "XI";

                            break;

                        case 12:

                            return "XII";

                            break;

                    }

    }

    private function generateInvoiceNo()
    {
        $month = $this->getRomawi(date('m'));

        $lastInvoice = DB::connection('mtr')
            ->table('mvm.mvm_invoice_h')
            ->where('invoice_type', 'TS3 TO CLIENT')
            ->orderBy('created_date', 'DESC')
            ->first();

        if (!$lastInvoice) {
            return '1/INV.TS3/' . $month . '/' . date('Y');
        }

        $lastSeq = explode('/', $lastInvoice->invoice_no)[0];
        $newSeq = intval($lastSeq) + 1;

        return $newSeq . '/INV.TS3/' . $month . '/' . date('Y');
    }

    public function InvoiceClientCreate(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
    
        if ($role === 'ADMIN TS3') {


            $username = Session::get('user_module')['username'] ?? null;

                // Periksa apakah ada invoice DRAFT yang sudah dibuat
                $checkInvoice = DB::connection('mtr')
                    ->table('mvm.mvm_invoice_h')
                    ->where('status', 'DRAFT')
                    ->where('invoice_type', 'TS3 TO CLIENT')
                    ->where('create_by', $username)
                    ->first();

                // Ambil data invoice BENGKEL TO TS3
                $invoicebkl = DB::connection('mtr')
                    ->table('mvm.v_invoice_list_create_admin')
                    ->selectRaw('id, invoice_no, invoice_type, SUM(jasa) as jasa, SUM(part) as part, bengkel_name, regional')
                    ->whereIn('status', ['PROSES', 'REQUEST'])
                    ->where('invoice_type', 'BENGKEL TO TS3')
                    ->groupBy('id', 'invoice_no', 'invoice_type', 'bengkel_name', 'regional')
                    ->get();

                // Tentukan nomor invoice baru jika tidak ada invoice DRAFT
                if (!$checkInvoice) {
                    $invoice_no = $this->generateInvoiceNo();
                } else {
                    $invoice_no = $checkInvoice->invoice_no;
                }

                // Ambil detail invoice
                $invoicedtl = DB::connection('mtr')
                    ->table('mvm.v_invoice_detail_prepare_admin_ts3')
                    ->where('invoice_no', $invoice_no)
                    ->get();

                // Hitung data utama invoice
                $invoiceData = DB::connection('mtr')
                    ->table('mvm.v_invoice_detail_prepare_admin')
                    ->selectRaw("
                        ROUND((SUM(jasa) * 2) / 100) as pph,
                        ROUND(((SUM(jasa) + SUM(part)) * 11) / 100) as ppn,
                        SUM(jasa) as jasa,
                        SUM(part) as part
                    ")
                    ->where('invoice_no', $invoice_no)
                    ->first();

                // Ambil detail invoice untuk ditampilkan
                $invoice_detail = DB::connection('mtr')
                    ->table('mvm.v_invoice_generate')
                    ->where('invoice_no', $invoice_no)
                    ->orderBy('service_no')
                    ->get();

                // Data yang dikirim ke view
                $data = [
                    'title'          => 'Invoice',
                    'invoicebkl'     => $invoicebkl,
                    'invoicedtl'     => $invoicedtl,
                    'invoice_no'     => $invoice_no,
                    'invoiceData'    => $invoiceData,
                    'invoice_detail' => $invoice_detail,
                    'content'        => 'invoice/admints3/invoice_create',
                ];

                return view('layout/wrapper', $data);
        }
    
        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);


     

    }

    private function generateInvoiceGPS($month, $currentYear)
    {
        $lastInvoice = DB::connection('mtr')
            ->table('mvm.mvm_gps_process')
            ->where('invoice_type', 'TS3 TO CLIENT GPS')
            ->whereIn('status', ['done', 'invoice'])
            ->orderBy('updated_date', 'DESC')
            ->first();

        if (!$lastInvoice) {
            // Jika tidak ada invoice sebelumnya, mulai dari nomor 1
            return '1/INV.GPS.TS3/' . $month . '/' . $currentYear;
        }

        // Ambil nomor urut dari invoice terakhir
        $lastSeq = explode('/', $lastInvoice->invoice_no)[0];
        $newSeq = intval($lastSeq) + 1;

        return $newSeq . '/INV.GPS.TS3/' . $month . '/' . $currentYear;
    }

    public function InvoiceClientCreateGps(Request $request)
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') 
        {
            $checkInvoice = DB::connection('mtr')->table('mvm.mvm_gps_process')->where('status_invoice','DRAFT')->where('invoice_type','TS3 TO CLIENT GPS')->first();
                    if(isset($checkInvoice) == false)
                    {
            
                        $month = $this->getRomawi(date("m"));
                        $currentYear = date("Y");
                    
                        // Periksa apakah ada invoice DRAFT
                        $checkInvoice = DB::connection('mtr')
                            ->table('mvm.mvm_gps_process')
                            ->where('status_invoice', 'DRAFT')
                            ->where('invoice_type', 'TS3 TO CLIENT GPS')
                            ->first();
                    
                        // Jika tidak ada invoice DRAFT, buat nomor invoice baru
                        $invoice_no = $checkInvoice
                            ? $checkInvoice->invoice_no
                            : $this->generateInvoiceGPS($month, $currentYear);
                    
                        // Ambil data list invoice dengan status 'service' dan belum ada nomor invoice
                        $invoicelist = DB::connection('mtr')
                            ->table('mvm.mvm_gps_process')
                            ->where('status', 'service')
                            ->whereNull('invoice_no')
                            ->get();
                    
                        // Data yang dikirim ke view
                        $data = [
                            'title'        => 'Invoice Client GPS',
                            'invoicelist'  => $invoicelist,
                            'invoice_no'   => $invoice_no,
                            'content'      => 'invoice/admints3/invoice_gps',
                        ];
                    return view('layout/wrapper',$data);
                }
            }
    
        return view('layout/wrapper', [
            'title' => 'Access Forbidden',
            'content' => 'global/notification/forbidden',
        ]);

    }


   




}
