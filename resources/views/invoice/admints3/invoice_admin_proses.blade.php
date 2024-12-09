<div class="modal fade" id="invoiceproses<?php echo $in->id ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" >
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Proses Invoice (<?php echo $in->invoice_no ?>)</h4>
                 
      
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
                        <form action="{{ asset('admin-ts3/invoice-admin-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                    
                                
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-right">Invoice No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="invoice_no" class="form-control" placeholder="Invoice No" value="<?php echo $in->invoice_no ?>" readonly required>
                                </div>
                            </div>
            
            
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-right">Remark</label>
                                <div class="col-sm-9">
                                    <textarea name="remark" id="remark" class="form-control" id="remark" placeholder="Remark">{{ old('address') }}</textarea>
            
                                </div>
                            </div>								


                                <div class="form-group row">
                                
                                    <div class="col-sm-12 text-center">
                                        <div class="form-group pull-right btn-group">
                                            <input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
                                            
                                            <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                </div>  
                            </div>     

                                </div>  
                            </div>      

             
                        </form>     

				
		
					</div>
		</div>
	</div>
</div>