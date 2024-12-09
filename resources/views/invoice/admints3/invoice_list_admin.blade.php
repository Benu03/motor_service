<div class="row">
    <div class="col-md-12">      

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-md" style="font-size: 12px;">
                    <thead>
                        <tr class="bg-info">                                                      
                       
                            <th  width="10%">NOPOL</th> 
                            <th width="15%">CABANG</th> 
                            <th width="10%">INVOICE</th>  
                            <th width="10%">Tanggal Service</th> 
                            <th width="7%">KM</th>   
                            <th width="7%">Jasa</th>  
                            <th width="7%">Barang</th>  
                            <th width="7%">PPN</th> 
                            <th width="7%">PPH 23</th>    
                            <th width="10%">Total Sebelum PPH 23</th>    
                            <th width="10%">Total Sesudah PPH 23</th>    
                       
                    </tr>
                    </thead>

                     <tbody>
                        <?php
                        use Illuminate\Support\Facades\DB;
                        $invoicedetail  = DB::connection('ts3')->table('mvm.v_invoice_detail_admin')->where('invoice_no',$invoice_no)->get();
                        ?>
                        <?php $i=1; foreach($invoicedetail as $ind) { ?>
                        <tr>
                        <td><?php echo $ind->nopol ?></td>     
                        <td><?php echo $ind->branch ?></td>  
                        <td><?php echo $ind->invoice_no ?></td>  
                        <td><?php echo $ind->tanggal_service ?></td>  
                        <td><?php echo $ind->last_km ?></td>                                             
                        <td><?php echo "Rp " . number_format($ind->jasa,0,',','.'); ?></td>
                        <td><?php echo "Rp " . number_format($ind->part,0,',','.'); ?></td>
                        <td><?php echo "Rp " . number_format($ind->ppn,0,',','.'); ?></td>
                        <td><?php echo "Rp " . number_format($ind->pph23,0,',','.'); ?></td>
                        <td><?php echo "Rp " . number_format(($ind->part+$ind->jasa+$ind->ppn),0,',','.'); ?></td>
                        <td><?php echo "Rp " . number_format(($ind->part+$ind->jasa+$ind->ppn)-$ind->pph23,0,',','.'); ?></td>
                
                        </td>
                         </tr>
                         <?php                          
                         $sumjasa[] =$ind->jasa;
                         $sumpart[] =$ind->part;
                         $sumppn[] =$ind->ppn;
                         $sumpph23[] =$ind->pph23;
                         $sumbeforepph23[] = $ind->part+$ind->jasa+$ind->ppn;
                         $sumafterpph23[] = ($ind->part+$ind->jasa+$ind->ppn)-$ind->pph23;
                         ?> 
                        <?php $i++; } ?> 
                        <tr>
                            <td colspan="5" class="bg-light"></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumjasa),0,',','.'); ?></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumpart),0,',','.'); ?></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumppn),0,',','.'); ?></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumpph23),0,',','.'); ?></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumbeforepph23),0,',','.'); ?></td>  
                            <td><?php echo "Rp " . number_format(array_sum($sumafterpph23),0,',','.'); ?></td>  
                        </tr>
                </tbody>
                            
            </table>
            </div>
          </div>

    </div>
</div>
