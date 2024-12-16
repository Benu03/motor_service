<?php

namespace App\Exports\AdminClient;

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
        $user_client = DB::connection('mtr')->table('auth.v_user_client')->where('username',Session()->get('username'))->first();
        $area 	= DB::connection('mtr')->table('mst.v_area')->selectRaw('regional,client_name ,area ,area_slug, create_by ,created_date')->where('client_name',$user_client->customer_name)->get();

        Log::info('Generate Excel');
        return  $area;
    }

    public function headings() :array
    {
        return ["REGIONAL", "CLIENT", "AREA","AREA_SLUG","USER_CREATE","DATE_CREATE"];
    }

}
