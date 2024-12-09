<div class="modal fade" id="addInvoicegps"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width:1200px; max-height:1200px;" >
		<div class="modal-content">
					<div class="modal-header">
		
					<h4 class="modal-title mr-4" id="myModalLabel">Add Invoice GPS</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form action="{{ asset('admin-ts3/invoice-gps-detail-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							<input type="hidden" id="invoice_no" name="invoice_no" value="{{ $invoice_no }}" >
							<div class="row">
								<div class="col-md-12">	


								        <div class="card">
											<div class="card-body">

														<div class="table-responsive mailbox-messages">
															<table id="invoicegps" class="display table table-bordered" cellspacing="0" width="100%" style="font-size: 12px;">
															<thead>
																<tr class="bg-info">
																	<th> 
																		<div class="mailbox-controls">
																			<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
																		</div>
																	</th>
																	<th>Service No</th>
																	<th>Nopol</th>
																	<th>GPS Serial Number</th>
																	<th>Tanggal Pemasangan</th>    
																	<th >Client</th>  
																	<th>User Install</th>    
																	
															</tr>
															</thead>
															<tbody>
																<?php $i=1; foreach($invoicelist as $in) { ?>
																	<tr>
																	<td class="text-center">
																									<div class="icheck-primary">
																										<input type="checkbox" class="icheckbox_flat-blue" name="id[]" value="<?php echo $in->id ?>" id="check<?php echo $i ?>">
																										<label for="check<?php echo $i ?>"></label>
																									</div>
																								</td>
																	<td><?php echo $in->service_no ?></td>
																	<td><?php echo $in->nopol ?></td>
																	<td><?php echo $in->sn_gps ?></td>
																	<td><?php echo $in->install_date ?></td>
																	<td><?php echo $in->client_invoice ?></td>
																	<td><?php echo $in->created_by ?></td>
																	
																</tr>
																
																<?php $i++; } ?> 

															</tbody>
															</table>
															</div>


											
											</div>
        								</div>


								

								<div class="form-group row">
								
									<div class="col-sm-12 text-center">
										<div class="form-group pull-right btn-group">
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


<script>
	var loadDataService = function(){
	const invoice_no_bengkel = $("#invoice_no_bengkel").val();
	console.log(invoice_no_bengkel);

	 $.ajax({    
		headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
		 type: "POST",
		 url: "{{ asset('admin-ts3/get-invoice')}}", 
		 data:{invoice_no_bengkel:invoice_no_bengkel},      
		 dataType: "JSON",                  
		 success: function(data){   
			console.log(data);
		


			
		 }
	 });
	};
	

	</script>
<script type="text/javascript">
$(document).ready(function() {
    var windowHeight = $(window).height();
    var sScrollY = 0.6 * windowHeight;

    // Inisialisasi DataTable
    var table = $('#invoicegps').DataTable({
        // "sScrollY": sScrollY + "px", // Set tinggi tabel
        "bPaginate": false, // Nonaktifkan paginasi
        "bJQueryUI": true, // Gunakan tema jQuery UI
        "bScrollCollapse": true, // Aktifkan gulir collapse
        "bAutoWidth": false, // Aktifkan penyesuaian lebar otomatis
        // "sScrollX": "100%", // Lebar tabel mengisi kontainer induk
        // "sScrollXInner": "100%" // Lebar isi tabel mengisi kontainer induk
    });

	jQuery('#invoicegps').wrap('<div class="dataTables_scroll" />');
	setTimeout(function () {
     $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
	},200);
});
</script>