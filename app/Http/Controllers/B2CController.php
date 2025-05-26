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
use Barryvdh\DomPDF\PDF;

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
    
            $timestamp = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $encryptionKey = config('static.key_access') . $timestamp;
            $keyPun = hash(config('static.key_hash'), $encryptionKey);
    
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'key-service' => $keyPun,
                'timestamp' => $timestamp
            ])->withoutVerifying()->post(config('static.url_generate_pdf_invoice'));
    

            if ($response->successful()) {
                $pdfContent = $response->body();
    

                return response($pdfContent, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="invoice.pdf"',
                ]);



            } else {
                return response()->json(['error' => 'Failed to get PDF from service'], 500);
            }
    
        } else {
            $data = [
                'title' => 'Access Forbidden',
                'content' => 'global/notification/forbidden',
            ];
    
            return view('layout/wrapper', $data);
        }
    }
    


    public function invoicepdfb2c($data)
    {
        Log::info('Begin Notif InvoiceGeneratePDF');

        $service =  DB::connection('mtr')
        ->table('mvm.mvm_service_user_h')
        ->where('invoice_no', $data)
        ->first();




        $invoice = DB::connection('mtr')
        ->table('mvm.mvm_invoice_user_h')
        ->where('invoice_no', $data)
        ->first();


     
             $invoice_detail = DB::connection('mtr')
            ->table('mvm.mvm_invoice_user_d')
            ->where('invoice_no', $data)
            ->get();
            
            $config = [];
    


            $pdf = app('dompdf.wrapper');
            $pdf->loadView('pdf/invoice_generate_user', [
                'invoice'        => $invoice,
                'invoice_detail' => $invoice_detail,
                'bengkel'        => $service,
                'config'         => $config
            ])->setPaper('a4', 'landscape');
    
            // Render PDF
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
    
            // Ambil ukuran halaman PDF
            $w = $canvas->get_width();
            $h = $canvas->get_height();
    
            // Tambahkan watermark (logo perusahaan)
            $imageURL = storage_path('data/image/logo_pdf.png');
            $imgWidth = 300;
            $imgHeight = 200;
    
            // Set opacity logo watermark
            $canvas->set_opacity(0.1);
    
            // Posisi tengah halaman
            $x = ($w - $imgWidth) / 2;
            $y = ($h - $imgHeight) / 2;
    
            // Tambahkan gambar watermark
            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);
    
            // Download PDF dengan nama file sesuai invoice
            return $pdf->stream($data . '.pdf');


        
    }
    
  
   




}