<?php

namespace App\Exports\AdminTs3;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class PriceServiceExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $price 	= DB::connection('mtr')->table('mst.v_price_service')->selectRaw('kode,service_name ,price_bengkel_to_ts3 , price_ts3_to_client ,client_name,price_service_type,regional ,create_by,created_date')->get();

        Log::info('Generate Excel');
       return  $price;
    }

    public function headings() :array
    {
        return ["KODE", "SERVICE_NAME", "PRICE_BENGKEL_TO_TS3","PRICE_TS3_TO_CLIENT","CLIENT", "PRICE_SERVICE_TYPE","REGIONAL","USER_CREATE","DATE_CREATE"];
    }

}
