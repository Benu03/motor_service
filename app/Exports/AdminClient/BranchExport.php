<?php

namespace App\Exports\AdminClient;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Log;


class BranchExport implements FromCollection , WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\CollectionS
    */
    public function collection()
    {
        $user_client = DB::connection('mtr')->table('auth.v_user_client')->where('username',Session()->get('username'))->first();
        $branch 	= DB::connection('mtr')->table('mst.v_branch')->selectRaw('client_name,regional,area,branch,pic_branch,phone,address,create_by ,created_date')->where('client_name',$user_client->customer_name)->get();

        Log::info('Generate Excel');
        return  $branch;
    }

    public function headings() :array
    {
        return ["CLIENT","REGIONAL","AREA","BRANCH","PIC_BRANCH","PHONE","ADDRESS","USER_CREATE","DATE_CREATE"];
    }

}
