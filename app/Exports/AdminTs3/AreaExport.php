<?php

namespace App\Exports\AdminTs3;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class AreaExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\CollectionS
    */
    public function collection()
    {
        $regional 	= DB::connection('mtr')->table('mst.v_area')->selectRaw('regional,client_name ,area ,area_slug, create_by ,created_date')->get();

        Log::info('Generate Excel');
        return  $regional;
    }

    public function headings() :array
    {
        return ["REGIONAL", "CLIENT", "AREA","AREA_SLUG","USER_CREATE","DATE_CREATE"];
    }

}
