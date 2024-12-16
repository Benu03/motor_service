<?php

namespace App\Exports\AdminClient;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Log;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Vehicle_schdule_export implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user_client = DB::connection('mtr')->table('auth.v_user_client')->where('username',Session()->get('username'))->first();
        // Log::info($user_client);
        Log::info('Generate Excel');
        return DB::connection('mtr')->table('mst.v_vehicle_last_service')->selectRaw('nopol,nomesin ,norangka , tahun_pembuatan ,"type" ,last_km ,tgl_last_service')->where('mst_client_id',$user_client->mst_client_id)->get(); 
    }

    public function headings() :array
    {
        return ["NOPOL", "NO MESIN", "NO RANGKA","TAHUN", "TYPE","KM TERAKHIR","TANGGAL SERVICE TERAKHIR"];
    }
}
