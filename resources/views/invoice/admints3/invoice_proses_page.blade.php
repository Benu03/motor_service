@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- <p>
  @include('admin-client/spk/tambah_upload')
</p> --}}
<form action="{{ asset('admin-ts3/invoice-proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row">
   
    <div class="col-md-6">
               
                <div class="form-group row">
                    <label class="col-sm-4 control-label text-left">Invoice No TS3</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="invoice_no_ts3" name="invoice_no_ts3" value="{{ old('invoice_no_ts3') }}" required>
                            </div> 
                    </div>
                 
                </div>
				<div class="form-group row">
					<label class="col-sm-4 control-label text-left">Invoice No Bengkel</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="invoice_no" name="invoice_no" value={{ $invoice->invoice_no }} required readonly>
                            </div> 
					</div>
                    <div class="col-sm-2">
                        <div class="form-group pull-right btn-group">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#invoice<?php echo $invoice->invoice_no ?>">
                                <i class="fa fa-eye"></i> Detail
                             </button>   
                             @include('admin-ts3/invoice/invoice_view_proses') 
                        </div>
                    </div>
                  
				</div>

                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Jasa</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="jasa" name="jasa" value="<?php echo "Rp " . number_format($invoice->jasa_total,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Spare Part</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="part" name="part" value="<?php echo "Rp " . number_format($invoice->part_total,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

             


        </div>         
    <div class="col-md-6">             

                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">PPN</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="pph" name="pph" value="<?php echo "Rp " . number_format($invoice->pph,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

               
               
                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">PPH 23</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="pph" name="pph" value="<?php echo "Rp " . number_format($invoice->pph,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>



                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Total</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="part" name="part" value="<?php echo "Rp " . number_format($invoice->jasa_total + $invoice->part_total,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>



             


                

              
               
    </div>
               




</div>

<div class="clearfix"><hr></div>

        <div class="row">
            <div class="col-sm-12">	 
                        <div class="row form-group">   
                             {{-- begin form	 --}} 
                            <div class="col-sm-12">	                               
                                
                                <div class="table-responsive mailbox-messages">
                                    <div class="table-responsive mailbox-messages">
                                    <table  class="table table-bordered" cellspacing="0" width="100%" style="font-size: 11px;">
                                <thead>
                                   
                                      
                                            <tr class="bg-info">                                                
                                                <th width="12%">Service No</th>  
                                                <th width="10%">Area</th>   
                                                <th width="12%">Cabang</th> 
                                                <th width="8%">Tanggal Service</th>   
                                                <th width="7%">NOPOL</th>
                                                <th width="15%">Merk</th>
                                                <th width="10%">Nama barang</th>  		 
                                                <th width="7%">Part</th>
                                                <th width="7%">Jasa</th> 
                                                <th width="8%">Jumlah</th>   	  				 
                                            </tr>
                                        </thead>
                              
                        
                                <tbody>
                                    <?php $i=1; foreach($invoice_detail as $ind) { ?>
                    
                    
                                    <tr>
                                        
                                        <td><?php echo $ind->service_no ?></td> 
                                        <td><?php echo $ind->area ?></td>  
                                        <td><?php echo $ind->branch ?></td> 
                                        <td><?php echo $ind->tanggal_service ?></td>
                                        <td><?php echo $ind->nopol ?></td> 
                                        <td><?php echo $ind->type ?></td>
                                        <td><?php echo $ind->service_name ?></td>  
                                        <td><?php if($ind->part == NULL) { echo "" ;} else { echo "Rp " . number_format($ind->part,0,',','.'); } ?></td>				                                            
                                        <td><?php if($ind->jasa == NULL) { echo "" ;} else { echo "Rp " . number_format($ind->jasa,0,',','.'); } ?></td>
                                        <td><?php echo "Rp " . number_format($ind->jasa+$ind->part,0,',','.'); ?></td>
                                    </tr>	
                    
                    
                                    <?php $i++; } ?> 
                                    <tr>
                                        {{-- <td colspan="4" style="border-bottom-style: hidden;border-left-style: hidden;"></td> --}}
                                        <th colspan="7" class="text-center">Total</th>
                                        <td ><?php echo "Rp " . number_format($invoice->part_total,0,',','.'); ?></td>
                                        <td ><?php echo "Rp " . number_format($invoice->jasa_total,0,',','.'); ?></td>
                                        <td ><?php echo "Rp " . number_format($invoice->jasa_total  + $invoice->part_total,0,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        {{-- <td colspan="4" style="border-bottom-style: hidden;border-left-style: hidden;"></td> --}}
                                        <th colspan="7" class="text-center">PPH 2%</th>
                                        <td ></td>
                                        <td > <?php echo "- Rp " . number_format($invoice->pph,0,',','.'); ?> </td>
                                        <td ></td>
                                    </tr>
                                    <tr>
                                       
                                        <th colspan="7" class="text-center">Total</th>
                                        <td ><?php echo "Rp " . number_format($invoice->part_total,0,',','.'); ?></td>
                                        <td ><?php echo "Rp " . number_format($invoice->jasa_total - $invoice->pph,0,',','.'); ?></td>
                                        <td ><?php echo "Rp " . number_format(($invoice->jasa_total - $invoice->pph) + $invoice->part_total,0,',','.'); ?></td>
                                    </tr>
                                    
                            
                                </tbody>

                                </table>
                                </div>

                                {{-- end form --}}
                            </div>

                        </div>
                    </div>
 
                </div>


<div class="clearfix"><hr></div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Proses Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/invoice') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

</div>    



</form>

<script>
    $('#reservation').daterangepicker()
</script>




