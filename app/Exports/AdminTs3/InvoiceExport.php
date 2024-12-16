<?php

namespace App\Exports\AdminTs3;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class InvoiceExport implements FromCollection ,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\CollectionS
    */

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection()
    {

     
        $invoice 	=  $invoice = DB::connection('mtr')->table('mvm.mvm_invoice_h')->where('id',$this->id)->first();      
        $invoice_detail = DB::connection('mtr')->table('mvm.v_invoice_detail_admin')->selectRaw("invoice_no, service_no, jasa,part,nopol,branch,type,tanggal_service,area,last_km,regional,pph23,ppn")
        
        ->where('invoice_no',$invoice->invoice_no)->get();

        Log::info('Generate Excel');
        return  $invoice_detail;
    }

    public function headings() :array
    {
        return ["invoice_no", "service_no", "jasa","part","nopol","branch","type","tanggal_service","area","last_km","regional","pph23","ppn"];
    }

}
