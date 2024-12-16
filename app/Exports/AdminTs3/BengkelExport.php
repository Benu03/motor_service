<?php

namespace App\Exports\AdminTs3;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class BengkelExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bengkel 	= DB::connection('mtr')->table('mst.v_bengkel_export')->get();

        Log::info('Generate Excel');
       return  $bengkel;
    }

    public function headings() :array
    {
        return ["BENGKEL_ID", "NAME", "ALIAS","PIC_BENGKEL", "PIC_EMAIL","PHONE_BENGKEL","ADDRESS","LAT","LONG","USER_CREATE","DATE_CREATE","USER_UPDATE","DATE_UPDATE"];
    }

}
