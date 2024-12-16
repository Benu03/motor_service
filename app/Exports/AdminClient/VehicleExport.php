<?php

namespace App\Exports\AdminClient;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class VehicleExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\CollectionS
    */
    public function collection()
    {
        $user_client = DB::connection('mtr')->table('auth.v_user_client')->where('username',Session()->get('username'))->first();
        $vehicle 	= DB::connection('mtr')->table('mst.v_vehicle')->selectRaw('client_name,
        nopol,
        norangka,
        nomesin,
        type,
        tahun_pembuatan,
        tgl_last_service,
        last_km,
        nama_stnk,
        create_by,
        created_date,
        remark')->where('client_name',$user_client->customer_name)->get();

        Log::info('Generate Excel');
        return  $vehicle;
    }

    public function headings() :array
    {
        return ["CLIENT","NOPOL","NO_RANGKA","NO_MESIN","TIPE","TAHUN","LAST_SERVICE","LASK_KM","NAMA_STNK","USER_CREATE","DATE_CREATE","REMARK"];
    }

}
