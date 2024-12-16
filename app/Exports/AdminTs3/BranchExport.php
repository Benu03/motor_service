<?php

namespace App\Exports\AdminTs3;

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
        $branch 	= DB::connection('mtr')->table('mst.v_branch')->selectRaw('client_name,regional,area,branch,pic_branch,phone,address,create_by ,created_date')->get();

        Log::info('Generate Excel');
        return  $branch;
    }

    public function headings() :array
    {
        return ["CLIENT","REGIONAL","AREA","BRANCH","PIC_BRANCH","PHONE","ADDRESS","USER_CREATE","DATE_CREATE"];
    }

}
