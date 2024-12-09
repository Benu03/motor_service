<div class="modal fade" id="invoice<?php echo $invoice->invoice_no ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Detail Invoice (<?php echo $invoice->invoice_no ?>)</h4>
                 
      
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
                        <div class="row mb-2">  
                                      
                                 <div class="col-md-12">
                                    <div class="card">  
                                        <div class="card-header">
                                        Invoice Data
                                        </div>
                                        <div class="card-body">  
                                        <div class="table-responsive-md">
                                        <table class="table table-bordered" style="font-size: 12px;">
                                  
                                            <thead>
                                                <tr class="bg-secondary">
                                                    
                                                    <th width="15%">Invoice Nomor</th>
                                                    <th width="15%">Tanggal Invoice</th>   
                                                    <th width="10%">Status</th> 
                                                    <th width="10%">PPH</th>  
                                                    <th width="10%">Jasa</th>  
                                                    <th width="10%">Part</th>  
                                                    <th width="10%">Total</th>  
                                                    <th width="10%">User Request</th>    
                                               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td><?php echo $invoice->invoice_no ?></td>
                                                <td><?php echo $invoice->created_date ?></td>
                                                <td><?php echo $invoice->status ?></td>
                                                <td><?php echo "Rp " . number_format($invoice->pph,0,',','.'); ?></td>
                                                <td><?php echo "Rp " . number_format($invoice->jasa_total,0,',','.'); ?></td>
                                                <td><?php echo "Rp " . number_format($invoice->part_total,0,',','.'); ?></td>
                                                <td><?php echo "Rp " . number_format(($invoice->jasa_total - $invoice->pph) + $invoice->part_total,0,',','.'); ?></td>
                                                <td><?php echo $invoice->create_by ?></td>
                                        
                                           
                                            </tr>
                                        </tbody>

                                        </table>
                                </div> 
                                </div>
                                     </div>
                              </div>           
                          </div>   
                          

                          <div class="row"> 
                            <div class="col-md-12 text-left">
                                <div class="card">  
                                    <div class="card-header">
                                    Invoice Detail
                                    </div>
                                    <div class="card-body">  
                                        <table class="table table-bordered table-sm" style="font-size: 11px;">
                                            <thead>
                                                <tr class="bg-light">                                                      
                                               
                                                    <th width="14%">SERVICE NO</th>   
                                                    <th width="8%">JASA</th> 
                                                    <th width="8%">PART</th>  
                                                    <th width="8%">NOPOL</th> 
                                                    <th width="10%">Area</th>   
                                                    <th width="15%">CABANG</th>  
                                                    <th width="17%">TIPE</th>  
                                                    <th width="10%">Tanggal Service</th>    
                                               
                                            </tr>
                                            </thead>

                                             <tbody>
                                                <?php
                                                use Illuminate\Support\Facades\DB;
                                                $invoicedetail  = DB::connection('ts3')->table('mvm.v_invoice_detail')->where('invoice_no',$invoice->invoice_no)->get();
                                                ?>
                                                <?php $i=1; foreach($invoicedetail as $ind) { ?>
                                                <tr>
                                                <td><?php echo $ind->service_no ?></td>                                              
                                                <td><?php echo "Rp " . number_format($ind->jasa,0,',','.'); ?></td>
                                                <td><?php echo "Rp " . number_format($ind->part,0,',','.'); ?></td>
                                                <td><?php echo $ind->nopol ?></td>  
                                                <td><?php echo $ind->area ?></td> 
                                                <td><?php echo $ind->branch ?></td>  
                                                <td><?php echo $ind->type ?></td>  
                                                <td><?php echo $ind->tanggal_service ?></td>
                                                </td>
                                                 </tr>
                                                <?php $i++; } ?> 
                                        </tbody>
                                                    
                                    </table>


                                    </div>           
                                    </div>   
        
                            </div>           
                        </div>   



                        
				
		
					</div>
		</div>
	</div>
</div>