<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Libraries\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use DataTables;
use App\Imports\VehicleTempImport;
use App\Exports\AdminTs3\VehicleExport;
use App\Exports\AdminTs3\BranchExport;
use App\Models\Branchmodel;
use Storage;
use App\Models\Vehicle_model;
use Illuminate\Support\Facades\File;

class MasterController extends Controller
{

    public function Bengkel(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $user_bengkel 	= DB::connection('sso')->table('auth.v_auth_user_module')
                                ->where('module','MOTOR SERVICE')
                                ->where('role','BENGKEL')
                                ->get();

            $data = array(  'title'     => 'Bengkel',
                            'userbengkel'      => $user_bengkel,
                            'content'   => 'master/admints3/bengkel'
                        );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function PriceService(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client = DB::connection('mtr')->table('mst.mst_client')->where('client_type', 'B2B')->get();
            $regional = DB::connection('mtr')->table('mst.mst_regional')->get();
            $kode_max = DB::connection('mtr')->table('mst.v_price_service')
                ->selectRaw("concat('TS3-', max(substring(kode from 5 for 5)::int + 1)) as kode")
                ->first();
            $price_type = DB::connection('mtr')->table('mst.mst_general')->where('name', 'price_service_type')->get();
    
      
            $data = compact('client', 'regional', 'kode_max', 'price_type');
            $data['title'] = 'Price Service';
            $data['content'] = 'master/admints3/price_service';
    
            return view('layout/wrapper', $data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function Regional(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $regional 	= DB::connection('mtr')->table('mst.v_regional')->get();
        $client 	= DB::connection('mtr')->table('mst.mst_client')->where('client_type','B2B')->get();

		$data = array(  'title'     => 'Regional',
                        'regional'      => $regional,
                        'client'      => $client,
                        'content'   => 'master/admints3/regional'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    
    public function Area(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $regional 	= DB::connection('mtr')->table('mst.v_regional')->get();

            $data = array(  'title'     => 'Area',
                            'regional'      => $regional,
                        'content'   => 'master/admints3/area'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function Branch(Request $request)
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client 	= DB::connection('mtr')->table('mst.v_client_product')->where('client_type','B2B')->get();

            $data = array(  'title'     => 'Branch',
                             'client'      => $client,
                            'content'   => 'master/admints3/branch'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function getArea(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
                
            if ($request->ajax()) {
                $area 	= DB::connection('ts3')->table('mst.v_area')->get();
                return DataTables::of($area)->addColumn('action', function($row){
                    $btn = '<div class="btn-group">
                    <a href="'. asset('admin-ts3/area/edit/'.$row->id).'" 
                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="'. asset('admin-ts3/area/delete/'.$row->id).'" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i></a>
                    </div>';
                        return $btn;
                        })->addColumn('check', function($row){
                            $check = ' <td class="text-center">
                                        <div class="icheck-primary">
                                        <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="'.$row->id.'" id="check'.$row->id.'">
                                    <label for="check'.$row->id.'"></label>
                                        </div>
                                    </td>';
                            return $check;
                        })
                ->rawColumns(['action','check'])->make(true);
       
            }

        }
            
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }
    

    public function AreaExport()
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
         return Excel::download(new AreaExport, 'AREA-MVM.xlsx');
        }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
    }

    public function Areaproses(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {      
       
                if(isset($_POST['hapus'])) {
                    $id       = $request->id;
            
                    for($i=0; $i < sizeof($id);$i++) {
                            
                    DB::connection('ts3')->table('mst.mst_area')->where('id',$id[$i])->delete();
                    
                    }
                
                    return redirect('area')->with(['sukses' => 'Data telah dihapus']);
              
                }
            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);
    }

    
    public function AreaAdd(Request $request)
    {
    	
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
            request()->validate([
                'mst_regional_id' => 'required',
                'area' 	   => 'required|unique:ts3.mst.mst_area',
                ]);


                DB::connection('ts3')->table('mst.mst_area')->insert([
                'mst_regional_id'   => $request->mst_regional_id,
                'area'	=> $request->area,
                'created_date'    => date("Y-m-d h:i:sa"),
                'create_by'     => $request->session()->get('username')
                ]);


                return redirect('area')->with(['sukses' => 'Data telah ditambah']);

            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);

                
    }

    public function EditArea($id)
    {
          
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
           \
                    $area 	= DB::connection('ts3')->table('mst.v_area')->where('id',$id)->first();
                    $regional 	= DB::connection('ts3')->table('mst.v_regional')->get();
        
                   
                   
                    $data = array(  'title'         => 'Edit area',
                                    'area'          => $area,
                                    'regional'        => $regional,
                                    'content'       => 'master/admints3/area_edit'
                            );
                

                    return view('layout/wrapper',$data);

            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);

    }


    public function EditAreaProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            request()->validate([
                'mst_regional_id'     => 'required',
                'area' => 'required',
                ]);

                DB::connection('ts3')->table('mst.mst_area')->where('id',$request->id)->update([
                    'mst_regional_id'   => $request->mst_regional_id,
                    'area'	    => $request->area,
                    'updated_at'    => date("Y-m-d h:i:sa"),
                    'update_by'     => $request->session()->get('username')
                ]);   
                return redirect('area')->with(['sukses' => 'Data telah diupdate']); 
            }
       
                    $data = [   'title' => 'Access Forbidden',
                                'content'   => 'global/notification/forbidden'
                            ];
            
                    return view('layout/wrapper',$data);
        
        
    }

    public function deleteArea($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            DB::connection('ts3')->table('mst.mst_area')->where('id',$id)->delete();
                return redirect('area')->wsith(['sukses' => 'Data telah dihapus']);

        }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function BranchExport()
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
        return Excel::download(new BranchExport, 'BRANCH-MVM.xlsx');
        }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
    }

    public function BranchUploadTemp()
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $file_path = storage_path('data/template/BRANCH_LIST_TEMPLATE.xlsx');
            return response()->download($file_path);
        }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    
    public function BranchUploadProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {


                    request()->validate([
                        'branch'   => 'file|mimes:xlsx,xls|max:5120|required',
                        ]);

                        $branch_file       = $request->file('branch');

                        try
                        {
                            DB::connection('mtr')->beginTransaction();
                            $nama_file = date("ymd_s").'_'.$branch_file->getClientOriginalName();
                            $dir_file =storage_path('data/branch/'.date("Y").'/'.date("m").'/');
                            // $DirFile ='data/spk/';
                            if (!file_exists($dir_file)) {
                            File::makeDirectory($dir_file,0777,true);
                            }

                            Log::info('done upload '.$nama_file);

                            Excel::import(new BranchTempImport(), $branch_file);
                            $branch_file->move($dir_file,$nama_file);

                            DB::connection('mtr')->commit();
                        }
                        catch (\Exception $e) {
                            DB::connection('ts3')->rollback();
                            return redirect('branch')->with(['warning' => $e]);
                        }    

                        $return =  $this->postingBranch($username = Session()->get('username')); 


                        return redirect('branch')->with(['sukses' => $return]);  
            }
        
                    $data = [   'title' => 'Access Forbidden',
                                'content'   => 'global/notification/forbidden'
                            ];
            
                    return view('layout/wrapper',$data);


    }

    public function postingBranch($username)
    {
     
        $Checkbranchtemp =  Branchmodel::GetBranchTemp($username); 

        foreach($Checkbranchtemp as $x => $val) 
        {

             $resultArray = json_decode(json_encode($val), true);
             $checkbranch = DB::connection('mtr')->table('mst.mst_branch')->where('branch',$resultArray['branch'])->first();

             if(!isset($checkbranch))
             {      
                $clientCheck = DB::connection('mtr')->table('mst.mst_client')->select('id')->where('client_name',$resultArray['client'])->first();
                if(isset($clientCheck))
                {

                    $checkregional = DB::connection('mtr')->table('mst.mst_regional')->where('regional',$resultArray['regional'])->first();
                    

                    if(isset($checkregional))
                    {
                        $checkarea = DB::connection('mtr')->table('mst.mst_area')->where('area',$resultArray['area'])->first();
                        if(isset($checkarea))
                        {

                            DB::connection('mtr')->table('mst.mst_branch')->insert([
                                'mst_area_id'   => $checkarea->id,
                                'branch'	=> $resultArray['branch'],
                                'pic_branch'	=> $resultArray['pic_branch'],
                                'phone'	=> $resultArray['phone'],
                                'address'	=> $resultArray['address'],
                                'created_date'    => date("Y-m-d h:i:sa"),
                                'create_by'     => $username
                            ]);
                        }
                        else
                        {
                            $idare =   DB::connection('mtr')->table('mst.mst_area')->insertGetId([
                                'mst_regional_id'   => $checkregional->id,
                                'area'	=> $resultArray['area'],
                                'created_date'    => date("Y-m-d h:i:sa"),
                                'create_by'     => $$username
                            ]);
    
                            DB::connection('mtr')->table('mst.mst_branch')->insert([
                                'mst_area_id'   => $idare,
                                'branch'	=> $resultArray['branch'],
                                'pic_branch'	=> $resultArray['pic_branch'],
                                'phone'	=> $resultArray['phone'],
                                'address'	=> $resultArray['address'],
                                'created_date'    => date("Y-m-d h:i:sa"),
                                'create_by'     => $username
                            ]);
                        }

                    }
                    else 
                    {
                        $idreg = DB::connection('mtr')->table('mst.mst_regional')->insertGetId([
                            'mst_client_id'   => $clientCheck->id,
                            'regional'	=> $resultArray['regional'],
                            'created_date'    => date("Y-m-d h:i:sa"),
                            'create_by'     => $username
                        ]);

                        $idare =   DB::connection('mtr')->table('mst.mst_area')->insertGetId([
                            'mst_regional_id'   => $idreg,
                            'area'	=> $resultArray['area'],
                            'created_date'    => date("Y-m-d h:i:sa"),
                            'create_by'     => $username
                        ]);

                        DB::connection('mtr')->table('mst.mst_branch')->insert([
                            'mst_area_id'   => $idare,
                            'branch'	=> $resultArray['branch'],
                            'pic_branch'	=> $resultArray['pic_branch'],
                            'phone'	=> $resultArray['phone'],
                            'address'	=> $resultArray['address'],
                            'created_date'    => date("Y-m-d h:i:sa"),
                            'create_by'     => $username
                        ]);


                    }


                }
                else
                {
                
                    Log::info('Client Belum Terdaftar '.$resultArray['client']);
                    return 'Client Belum Terdaftar '.$resultArray['client'];
                }

             }
             else
             {
                 Log::info('Branch Sudah ada '.$resultArray['branch']);
                 return 'Branch Sudah ada '.$resultArray['branch'];
             }


        }
        DB::connection('mtr')->table('tmp.tmp_branch')->where('user_upload',$username)->delete();

        return 'File berhasil Di Upload, mohon Untuk Di Review';

    }
    

    public function getBranch(Request $request)
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

                        if ($request->ajax()) {
                            $branch 	= DB::connection('mtr')->table('mst.v_branch')->get();
                            return DataTables::of($branch)->addColumn('action', function($row){
                                $btn = '<div class="btn-group">
                                <a href="'. asset('edit-branch/'.$row->id).'" 
                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="'. asset('delete-branch/'.$row->id).'"  class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i></a>
                                </div>';
                                    return $btn;
                                    })->addColumn('check', function($row){
                                        $check = ' <td class="text-center">
                                                    <div class="icheck-primary">
                                                    <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="'.$row->id.'" id="check'.$row->id.'">
                                                <label for="check'.$row->id.'"></label>
                                                    </div>
                                                </td>';
                                        return $check;
                                    })
                            ->rawColumns(['action','check'])->make(true);
                            }
                    }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function Branchproses(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {      
       
                if(isset($_POST['hapus'])) {
                    $id       = $request->id;
            
                    for($i=0; $i < sizeof($id);$i++) {
                            
                    DB::connection('mtr')->table('mst.mst_branch')->where('id',$id[$i])->delete();
                    
                    }
                
                    return redirect('branch')->with(['sukses' => 'Data telah dihapus']);
                }
            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);
    }

    
    public function BranchAdd(Request $request)
    {
    	
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
                request()->validate([
                                    'mst_area_id' => 'required',
                                    'branch' 	   => 'required|unique:mtr.mst.mst_branch',
                                    'pic_branch' => 'required',
                                    ]);


                DB::connection('mtr')->table('mst.mst_branch')->insert([
                    'mst_area_id'   => $request->mst_area_id,
                    'branch'	=> $request->branch,
                    'pic_branch'	=> $request->pic_branch,
                    'phone'	=> $request->phone,
                    'address'	=> $request->address,
                    'created_date'    => date("Y-m-d h:i:sa"),
                    'create_by'     => $request->session()->get('username')
                ]);


                return redirect('branch')->with(['sukses' => 'Data telah ditambah']);

            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);

                
    }

    public function EditBranch($id)
    {
          
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
            $branch 	= DB::connection('mtr')->table('mst.v_branch')->where('id',$id)->first();
            $area 	= DB::connection('mtr')->table('mst.v_area')->get();
            $user_branch 	= DB::connection('sso')->table('auth.v_auth_user_module')
                                ->where('module','MOTOR SERVICE')
                                ->where('role','ADMIN CLIENT')
                                ->get();
     
		    $data = array(  'title'         => 'Edit Branch',
                            'area'          => $area,
                            'branch'        => $branch,
                            'userbranch'      => $user_branch,
                            'content'       => 'master/admints3/branch_edit'
                    );
        
                    return view('layout/wrapper',$data);

            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);

    }


    public function EditBranchProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

                        request()->validate([
                                            'mst_area_id'     => 'required',
                                            'branch' => 'required',
                                            'pic_branch' => 'required',
                                            ]);

                                            DB::connection('mtr')->table('mst.mst_branch')->where('id',$request->id)->update([
                                                'mst_area_id'   => $request->mst_area_id,
                                                'branch'	    => $request->branch,
                                                'pic_branch'	=> $request->pic_branch,
                                                'phone'	=> $request->phone,
                                                'address'	=> $request->address,
                                                'updated_at'    => date("Y-m-d h:i:sa"),
                                                'update_by'     => $request->session()->get('username')
                                            ]);   
                        return redirect('branch')->with(['sukses' => 'Data telah diupdate']);   
            }
       
                    $data = [   'title' => 'Access Forbidden',
                                'content'   => 'global/notification/forbidden'
                            ];
            
                    return view('layout/wrapper',$data);
        
        
    }

    public function deleteBranch($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

                DB::connection('mtr')->table('mst.mst_branch')->where('id',$id)->delete();
                return redirect('branch')->with(['sukses' => 'Data telah dihapus']);

        }
        
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function Vehicle(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $client 	= DB::connection('mtr')->table('mst.mst_client')->where('client_type','B2B')->get();
        $vehicle_type 	= DB::connection('mtr')->table('mst.mst_vehicle_type')->get();

		$data = array(  'title'     => 'Vehicle',
                        'vehicle_type'      => $vehicle_type,
                        'client'      => $client,
                        'content'   => 'master/admints3/vehicle'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }


    public function VehicleType(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

            $group_vehicle 	= DB::connection('mtr')->table('mst.mst_general')->where('name','Group Vehicle')->where('value_1','Motor')->get();

            $data = array(  'title'     => 'Vehicle Type',
                    
                            'group_vehicle'      => $group_vehicle,
                    
                        'content'   => 'master/admints3/vehicle_type'
                    );
            
            return view('layout/wrapper',$data);

        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);

    }

    public function getVehicletype(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

                if ($request->ajax()) {
                

                $vehiclet 	= DB::connection('mtr')->table('mst.mst_vehicle_type')->get();
                
                return DataTables::of($vehiclet)
                        ->addColumn('action', function($row){
                            $btn = '<div class="btn-group">
                                    <a href="'. asset('edit-vehicle-type/'.$row->id).'" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="'. asset('delete-vehicle-type/'.$row->id).'" class="btn btn-danger btn-sm  delete-link">
                                            <i class="fa fa-trash"></i></a>
                                    </div>';
                        return $btn; })
                        ->addColumn('check', function($row){
                            $check = ' <td class="text-center">
                                        <div class="icheck-primary">
                                        <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="'.$row->id.'" id="check'.$row->id.'">
                                    <label for="check'.$row->id.'"></label>
                                        </div>
                                    </td>';
                            return $check; })
                        ->rawColumns(['action','check'])
                        ->make(true);
            
                }
            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);                

    }

    public function VehicleTypeAdd(Request $request)
    {   
    	
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {


    	request()->validate(['group_vehicle' 	   => 'required',
					        'type' => 'required|unique:mtr.mst.mst_vehicle_type',
					        'tahun_pembuatan' 	   => 'required',
					        ]);



                DB::connection('mtr')->table('mst.mst_vehicle_type')->insert([
                    'group_vehicle'   => $request->group_vehicle,
                    'type'   => $request->type,
                    'tahun_pembuatan'	=> $request->tahun_pembuatan,
                    'desc'	=> $request->desc,
                    'created_date'    => date("Y-m-d h:i:sa"),
                    'create_by'     => $request->session()->get('username')
                ]);
                return redirect('vehicle-type')->with(['sukses' => 'Data telah ditambah']);

            }
            
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];

            return view('layout/wrapper',$data);       
    }


    public function VehicleTypeProcess(Request $request)
    {
       
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
       

            if(isset($_POST['hapus'])) {
                $id       = $request->id;
        
                for($i=0; $i < sizeof($id);$i++) {
                        
                DB::connection('mtr')->table('mst.mst_vehicle_type')->where('id',$id[$i])->delete();
                
                }
            
                return redirect('vehicle-type')->with(['sukses' => 'Data telah dihapus']);
        
            }

        }
                
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);  




    }


    public function EditVehicleType($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
           
           
            $vehicle_type 	= DB::connection('mtr')->table('mst.mst_vehicle_type')->where('id',$id)->first();
            $group_vehicle 	= DB::connection('mtr')->table('mst.mst_general')->where('name','Group Vehicle')->where('value_1','Motor')->get();
		    $data = array(  'title'     => 'Edit Vehicle Type',						
                            'vehicle_type'      => $vehicle_type,
                            'group_vehicle'      => $group_vehicle,
                            'content'   => 'master/admints3/vehicle_type_edit'
                    );
        
             return view('layout/wrapper',$data);

            }
       
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);
    }


    public function EditVehicleTypeProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
            
            request()->validate([
                                    'group_vehicle' 	   => 'required',
                                    'type' => 'required',
                                    'tahun_pembuatan' 	   => 'required',
                                ]);

                                DB::connection('mtr')->table('mst.mst_vehicle_type')->where('id',$request->id)->update([
                                    'group_vehicle'   => $request->group_vehicle,
                                    'type'   => $request->type,
                                    'tahun_pembuatan'	=> $request->tahun_pembuatan,
                                    'desc'	=> $request->desc,
                                    'updated_at'    => date("Y-m-d h:i:sa"),
                                    'update_by'     => $request->session()->get('username')
                                ]);   
            return redirect('vehicle-type')->with(['sukses' => 'Data telah diupdate']);         
            
        }
       
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
    }
    

    public function DeleteVehicleType($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {
            
        
            DB::connection('mtr')->table('mst.mst_vehicle_type')->where('id',$id)->delete();
            return redirect('vehicle-type')->with(['sukses' => 'Data telah dihapus']);

            }
            
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];

            return view('layout/wrapper',$data);
    }

    public function getVehicle(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {

                if ($request->ajax()) {
                

                $vehicle 	= DB::connection('mtr')->table('mst.v_vehicle')->get();
                
                return DataTables::of($vehicle)
                        ->addColumn('action', function($row){
                            $btn = '<div class="btn-group">
                                    <a href="'. asset('vehicle-detail/'.$row->id).'" 
                                        class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="'. asset('edit-vehicle/'.$row->id).'" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="'. asset('delete-vehicle/'.$row->id).'" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i></a>
                                    </div>';
                        return $btn; })
                        ->addColumn('check', function($row){
                            $check = ' <td class="text-center">
                                        <div class="icheck-primary">
                                        <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="'.$row->id.'" id="check'.$row->id.'">
                                    <label for="check'.$row->id.'"></label>
                                        </div>
                                    </td>';
                            return $check; })
                        ->rawColumns(['action','check'])
                        ->make(true);
            
                }
            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];

            return view('layout/wrapper',$data);
    }
       

    public function VehicleAdd(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {



                request()->validate(['mst_client_id' 	   => 'required',
                                    'nopol' => 'required|unique:mtr.mst.mst_vehicle',
                                    'norangka' => 'required|unique:mtr.mst.mst_vehicle',
                                    'nomesin' => 'required|unique:mtr.mst.mst_vehicle',
                                    'mst_vehicle_type_id' => 'required',
                                    ]);

                            
                DB::connection('mtr')->table('mst.mst_vehicle')->insert([
                    'mst_client_id'	=> $request->mst_client_id,
                    'nopol'   => strtoupper(str_replace(' ', '', $request->nopol)),
                    'norangka'   => strtoupper(str_replace(' ', '', $request->norangka)),
                    'nomesin'   => strtoupper(str_replace(' ', '', $request->nomesin)),
                    'mst_vehicle_type_id'   => $request->mst_vehicle_type_id,
                    'remark'   => $request->remark,
                    'created_date'    => date("Y-m-d h:i:sa"),
                    'create_by'     => $request->session()->get('username')
                ]);
                return redirect('vehicle')->with(['sukses' => 'Data telah ditambah']);

            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];

            return view('layout/wrapper',$data);

    }

    public function Vehicleproses(Request $request)
    { 
        
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {       

            if(isset($_POST['hapus'])) {
                $id       = $request->id;
        
                for($i=0; $i < sizeof($id);$i++) {
                        
                DB::connection('mtr')->table('mst.mst_vehicle')->where('id',$id[$i])->delete();
                
                }
            
                return redirect('vehicle')->with(['sukses' => 'Data telah dihapus']);
        
            }
        }
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);



    }


    public function EditVehicle($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {      
           
            $client 	= DB::connection('mtr')->table('mst.mst_client')->where('client_type','B2B')->get();
            $vehicle 	= DB::connection('mtr')->table('mst.v_vehicle')->where('id',$id)->first();
            $vehicle_type 	= DB::connection('mtr')->table('mst.mst_vehicle_type')->get();
		    $data = array(  'title'     => 'Edit Vehicle',						
                        'vehicle'      => $vehicle,
                        'vehicle_type'      => $vehicle_type,
                        'client'      => $client,
                        'content'   => 'master/admints3/vehicle_edit'
                    );
        
             return view('layout/wrapper',$data);
            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);
    }


    public function EditVehicleProcess(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {   
                request()->validate(['mst_client_id' 	   => 'required',
                                    'nopol' => 'required',
                                    'norangka' => 'required',
                                    'nomesin' => 'required',
                                    'mst_vehicle_type_id' => 'required',
                                    ]);

                                    DB::connection('mtr')->table('mst.mst_vehicle')->where('id',$request->id)->update([
                                        'mst_client_id'	=> $request->mst_client_id,
                                        'nopol'   => strtoupper(str_replace(' ', '', $request->nopol)),
                                        'norangka'   => strtoupper(str_replace(' ', '', $request->norangka)),
                                        'nomesin'   => strtoupper(str_replace(' ', '', $request->norangka)),
                                        'mst_vehicle_type_id'   => $request->mst_vehicle_type_id,
                                        'remark'   => $request->remark,
                                        'updated_at'    => date("Y-m-d h:i:sa"),
                                        'update_by'     => $request->session()->get('username')
                                    ]);   
                return redirect('vehicle')->with(['sukses' => 'Data telah diupdate']);
            }
            $data = [   'title' => 'Access Forbidden',
                        'content'   => 'global/notification/forbidden'
                    ];
    
            return view('layout/wrapper',$data);                                             
    }


    public function deleteVehicle($id)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {   
     
            DB::connection('mtr')->table('mst.mst_vehicle')->where('id',$id)->delete();
            return redirect('vehicle')->with(['sukses' => 'Data telah dihapus']);

        }
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);            
    }


    public function VehicleDetail($id)
    {

        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {   
        $vehicle 	= DB::connection('mtr')->table('mst.v_vehicle')->where('id',$id)->first();
        $data = array(  'title'             => $vehicle->nopol,
                        'vehicle'             => $vehicle,
                        'content'           => 'master/admints3/vehicle_detail'
                    );
        return view('layout/wrapper',$data);

        }
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);       
    }
    

    public function VehicleTemplateUpload()
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {   
    
        $file_path = storage_path('data/template/VEHICLE_LIST_TEMPLATE.xlsx');
        return response()->download($file_path);
        }
        $data = [   'title' => 'Access Forbidden',
                    'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);  

    }

    public function VehicleUpload(Request $request)
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {   

                    request()->validate([
                        'vehicle'   => 'file|mimes:xlsx,xls|max:5120|required',
                        ]);

                        $vehicle_file       = $request->file('vehicle');
                        $username = Session::get('user_module')['username'] ?? null;

                        try
                        {
                            DB::connection('mtr')->beginTransaction();
                            $nama_file = date("ymd_s").'_'.$vehicle_file->getClientOriginalName();
                            $dir_file =storage_path('data/vehicle/'.date("Y").'/'.date("m").'/');
       
                            if (!file_exists($dir_file)) {
                            File::makeDirectory($dir_file,0777,true);
                            }

                            Log::info('done upload '.$nama_file);

                            Excel::import(new VehicleTempImport(), $vehicle_file);
                            $vehicle_file->move($dir_file,$nama_file);

                            DB::connection('mtr')->commit();
                        }
                        catch (\Exception $e) {
                            DB::connection('mtr')->rollback();
                            return redirect('vehicle')->with(['warning' => $e]);
                        }    

                        $return =  $this->Postingvehicle($username); 


                        return redirect('vehicle')->with(['sukses' => 'File berhasil Di Upload, mohon Untuk Di Review']);  

                    }
                    $data = [   'title' => 'Access Forbidden',
                                'content'   => 'global/notification/forbidden'
                            ];
            
                    return view('layout/wrapper',$data); 
    }


    private function Postingvehicle($username)
    {
        $vehicles = Vehicle_model::GetTempVehicle($username);
    
        foreach ($vehicles as $vehicle) {
            $vehicleData = json_decode(json_encode($vehicle), true);
    
            // Check vehicle type
            $vehicleType = DB::connection('mtr')->table('mst.mst_vehicle_type')
                ->select('id')
                ->where('type', $vehicleData['type'])
                ->where('tahun_pembuatan', $vehicleData['tahun_pembuatan'])
                ->first();
    
            // Check if license plate (nopol) exists
            $existingVehicle = DB::connection('mtr')->table('mst.mst_vehicle')
                ->where('nopol', $vehicleData['nopol'])
                ->exists();
    
            if ($existingVehicle) {
                Log::info('Vehicle already exists: ' . $vehicleData['nopol']);
                continue;
            }
    
            // Check client
            $client = DB::connection('mtr')->table('mst.mst_client')
                ->select('id')
                ->where('client_name', $vehicleData['client'])
                ->first();
    
            if (!$client) {
                DB::connection('mtr')->table('tmp.tmp_vehicle')->where('user_upload', $username)->delete();
                Log::info('Client not registered: ' . $vehicleData['client']);
                return 'Data Client Tidak Terdaftar';
            }
    
            // Insert vehicle type if not exists
            if (!$vehicleType) {
                $vehicleTypeId = DB::connection('mtr')->table('mst.mst_vehicle_type')->insertGetId([
                    'group_vehicle' => 'Motor',
                    'type' => $vehicleData['type'],
                    'tahun_pembuatan' => $vehicleData['tahun_pembuatan'],
                    'desc' => '',
                    'mst_client_id' => $client->id,
                    'created_date' => now(),
                    'create_by' => $username
                ]);
            } else {
                $vehicleTypeId = $vehicleType->id;
            }
    
            // Insert vehicle
            DB::connection('mtr')->table('mst.mst_vehicle')->insert([
                'mst_client_id' => $client->id,
                'nopol' => strtoupper(str_replace(' ', '', $vehicleData['nopol'])),
                'norangka' => strtoupper(str_replace(' ', '', $vehicleData['norangka'])),
                'nomesin' => strtoupper(str_replace(' ', '', $vehicleData['nomesin'])),
                'mst_vehicle_type_id' => $vehicleTypeId,
                'tgl_last_service' => $vehicleData['tgl_last_service'],
                'last_km' => $vehicleData['last_km'],
                'nama_stnk' => $vehicleData['nama_stnk'],
                'remark' => '',
                'created_date' => now(),
                'create_by' => $username
            ]);
        }
    
        // Delete temporary vehicles
        DB::connection('mtr')->table('tmp.tmp_vehicle')->where('user_upload', $username)->delete();
    
        return 'File berhasil di-upload, mohon untuk direview';
    }
    
    public function VehicleExport()
    {
        $role = Session::get('modules')['role'] ?? null;
                if ($role === 'ADMIN TS3') {   


                        return Excel::download(new VehicleExport, 'VEHICLE-MVM.xlsx');
                    }
                    $data = [   'title' => 'Access Forbidden',
                                'content'   => 'global/notification/forbidden'
                            ];

                    return view('layout/wrapper',$data); 
    }


    

    public function getAreaClient()
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {  
                  
                    $client = $_POST['client'];
                    log::info($client);

                    $area = DB::connection('mtr')->table('mst.v_area')->where('client_name',$client)->pluck('id', 'area_slug');
                

                    return response()->json($area);
            }
            $data = [   'title' => 'Access Forbidden',
            'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
     
    }


    public function getBranchpicClient()
    {
        $role = Session::get('modules')['role'] ?? null;
        if ($role === 'ADMIN TS3') {  
                        $client = $_POST['client'];
                    
                        $pic = DB::connection('sso')->table('auth.v_auth_user_module')
                        ->where('module','MOTOR SERVICE')
                        ->where('role','ADMIN CLIENT')
                        // ->where('entity',$client)
                        ->select('username', 'fullname', 'entity')
                        ->get();

                        return response()->json($pic);
                      
            }
            $data = [   'title' => 'Access Forbidden',
            'content'   => 'global/notification/forbidden'
                ];

        return view('layout/wrapper',$data);
     
    }


}
