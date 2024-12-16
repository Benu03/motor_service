<?php

namespace App\Exports\AdminClient;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class RegionalExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\CollectionS
    */
    public function collection()
    {
        $user_client = DB::connection('mtr')->table('auth.v_user_client')->where('username',Session()->get('username'))->first();
        $regional 	= DB::connection('mtr')->table('mst.v_regional')->selectRaw('regional,client_name ,regional_slug , create_by ,created_date')->where('client_name',$user_client->customer_name)->get();

        Log::info('Generate Excel');
        return  $regional;
    }

    public function headings() :array
    {
        return ["REGIONAL", "CLIENT", "REGIONAL_SLUG","USER_CREATE","DATE_CREATE"];
    }

}
