<div class="modal fade" id="addService"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width:1600px; max-height:1600px;">
		<div class="modal-content">
					<div class="modal-header">
		
					<h4 class="modal-title mr-4" id="myModalLabel">Add Service</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form action="{{ asset('bengkel/invoice-create-detail-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
						
							<input type="hidden" id="invoice_no" name="invoice_no" value="{{ $invoice_no }}" >
							<div class="row">
								<div class="col-md-12">	

									<div class="table-responsive mailbox-messages">
								
											<table id="example4" class="display table table-bordered table-sm " cellspacing="0" width="100%" style="font-size: 12px;">
											<thead>
												<tr class="bg-info">
													<th width="5%">
														<div class="mailbox-controls">
															<!-- Check all button -->
															<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
															</button>
														</div>
													</th>        
													<th width="12%">SERVICE NO</th>
													<th width="12%">CABANG</th>
													<th width="10%">NOPOL</th>  
													<th width="10%">LAST KM</th>  
													<th width="10%">TANGGAL SERVICE</th>  
													<th width="10%">JASA</th>  
													<th width="10%">PART</th>  
										
											</tr>
											</thead>
											<tbody>
												<?php $i=1; foreach($service_invoice as $si) { ?>
													<tr>
														<td class="text-center">
															<div class="icheck-primary">
																	<input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="<?php echo $si->service_no ?>" id="check<?php echo $i ?>">
																	<label for="check<?php echo $i ?>"></label>
															</div>
															{{-- <small class="text-center"><?php echo $i ?></small> --}}
														</td>
													<td><?php echo $si->service_no ?></td>
													<td><?php echo $si->branch ?></td>
													<td><?php echo $si->nopol ?></td>
													<td><?php echo $si->last_km ?></td>
													<td><?php echo $si->tanggal_service ?></td>
													<td><?php     
														$strjasa = $si->jasa_name;
														$delimiterjasa = ',';
														$jasa_name = explode($delimiterjasa, $strjasa);
														foreach ($jasa_name as $jn) {
															echo "<span class='badge badge-pill badge-primary mr-2 mb-1'>$jn </span>" ;
														}
													 ?></td>

													<td><?php     
														$strpart = $si->part_name;
														$delimiterpart = ',';
														$part_name = explode($delimiterpart, $strpart);
														foreach ($part_name as $pn) {
															echo "<span class='badge badge-pill badge-success mr-2 mb-1'>$pn </span>" ;
														}
													?></td>

													
													
												</tr>
												
												<?php $i++; } ?> 
											
											</tbody>
											</table>
							
										</div>
								



								<div class="form-group row">
								
									<div class="col-sm-12 text-center">
										<div class="form-group pull-right btn-group">
											{{-- <input type="submit" name="submit" class="btn btn-primary " value="Simpan Data"> --}}
											<button class="btn btn-primary" type="submit" name="invoice_create" onClick="check();" >
												<i class="fa fa-plus"></i> Submit
											</button> 
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

{{-- 
<script>
	var loadDataService = function(){
	const service_no = $("#service_no").val();
	console.log(service_no);
	
	$.ajax({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    type: "POST",
    url: "{{ asset('bengkel/service/get-service') }}",
    data: { service_no: service_no },
    dataType: "JSON",
    success: function(data) {
        console.log(data);
        document.getElementById('tanggal_service').value = data.tanggal_service;
        document.getElementById('branch').value = data.branch;
        document.getElementById('nopol').value = data.nopol;

        var selectElement = document.getElementById('jasa_id');
        var jasaValues = data.jasa.split(',');

        for (var i = 0; i < selectElement.options.length; i++) {
            if (jasaValues.includes(selectElement.options[i].value)) {
                selectElement.options[i].selected = true;
            }
        }
    },
    error: function(xhr, status, error) {
        console.log(xhr.responseText);
    }
});


	};
	
	
	</script> --}}