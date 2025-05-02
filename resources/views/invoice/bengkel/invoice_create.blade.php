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
{{-- <form action="{{ asset('bengkel/invoice-create-proses') }}" method="post" accept-charset="utf-8"> --}}
{{-- {{ csrf_field() }} --}}
<div class="row">
   
    <div class="col-md-6">
               
				<div class="form-group row">
					<label class="col-sm-4 control-label text-left">Invoice No</label>
					<div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="invoice_no" name="invoice_no" value={{ $invoice_no }} required readonly>
                            </div> 
					</div>
                    <div class="col-sm-4">
                        <div class="form-group pull-right btn-group">
                            <button class="btn btn-success " type="button" data-toggle="modal" data-target="#addService">
                                <i class="fas fa-plus-circle"></i> Add Service
                            </button>
                            @include('bengkel/invoice/add_service') 
                        </div>
					</div>
				</div>
        </div>         
    <div class="col-md-6">
        @if ($invoiceData->jasa != null)
                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">PPH</label>
					<div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="pph" name="pph" value="<?php echo "Rp " . number_format($invoiceData->pph,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

               
                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Jasa</label>
					<div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="jasa" name="jasa" value="<?php echo "Rp " . number_format($invoiceData->jasa,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Spare Part</label>
					<div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="part" name="part" value="<?php echo "Rp " . number_format($invoiceData->part,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>


                <div class="form-group row">
					<label class="col-sm-4 control-label text-left">Total</label>
					<div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="part" name="part" value="<?php echo "Rp " . number_format(($invoiceData->jasa - $invoiceData->pph) + $invoiceData->part,0,',','.');  ?>" required readonly>
                            </div> 
					</div>
				</div>

                @endif
               
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
                                <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="bg-info">
                                        <th width="5%">
                                         No
                                        </th>
                                        <th width="20%">Service No</th>
                                        <th width="15%">Jasa</th>
                                        <th width="15%">Spare part</th>    
                                        <th width="15%">Jumlah</th> 
                                        <th width="15%">Create</th> 
                                        <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    <?php $i=1; foreach($invoicedtl as $ind) { ?>
                                
                                    <td class="text-center">
                                        <?php echo $i ?>
                                    </td>
                                    <td><?php echo $ind->service_no ?></td>
                                    <td><?php echo "Rp " . number_format($ind->jasa,0,',','.');  ?></td>
                                    <td><?php echo "Rp " . number_format($ind->part,0,',','.'); ?></td>
                                    <td><?php echo "Rp " . number_format($ind->jasa+$ind->part,0,',','.');?></td>
                                    <td><?php echo $ind->create_by ?></td>
                                    <td>
                                        <div class="btn-group">                       
                                          <a href="{{ asset('bengkel/invoice-detail/delete/'.$ind->service_no) }}" class="btn btn-danger btn-sm  delete-service">
                                            <i class="fa fa-trash"></i></a>
                                        </div>   
                                    </td>
                                </tr>
                                
                                <?php $i++; } ?>
                                
                                </tbody>
                                </table>
                                </div>

                                {{-- end form --}}
                            </div>

                        </div>
                    </div>
 
                </div>


<div class="clearfix"><hr></div>
<div class="row">
    <div class="col-sm-12 text-center">	 
    @include('bengkel/invoice/invoice_submit')
    </div>
    </div>
</div>    



{{-- </form> --}}

<script>
    $('#reservation').daterangepicker()
</script>




