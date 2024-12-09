<div class="modal fade" id="addInvoice"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width:1200px; max-height:1200px;" >
		<div class="modal-content">
					<div class="modal-header">
		
					<h4 class="modal-title mr-4" id="myModalLabel">Add Invoice</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form action="{{ asset('admin-ts3/invoice-create-detail-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							<input type="hidden" id="invoice_no" name="invoice_no" value="{{ $invoice_no }}" >
							<div class="row">
								<div class="col-md-12">	


								        
                <div class="table-responsive mailbox-messages">
                    <table id="invoicedatatables" name="invoicedatatables" class="display table table-bordered table-sm" cellspacing="0" width="100%" style="font-size: 10px; max-width: none;">
                        <thead>
                            <tr class="bg-info">
							<th> <!-- Sesuaikan lebar kolom dengan persentase yang sesuai -->
            <div class="mailbox-controls">
                <!-- Tombol Check all -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
            </div>
        </th>        
        <th>Invoice Nomor</th>
        <th>Regional</th>
        <th>Jasa</th>  
        <th>Part</th>  
        <th>Bengkel</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($invoicebkl as $in) { ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="icheck-primary">
                                            <input type="checkbox" class="icheckbox_flat-blue" name="id[]" value="<?php echo $in->id ?>" id="check<?php echo $i ?>">
                                            <label for="check<?php echo $i ?>"></label>
                                        </div>
                                    </td>
                                    <td><?php echo $in->invoice_no ?></td>
                                    <td><?php echo $in->regional ?></td>
                                    <td><?php echo "Rp " . number_format($in->jasa,0,',','.'); ?></td>
                                    <td><?php echo "Rp " . number_format($in->part,0,',','.'); ?></td>
                                    <td><?php echo $in->bengkel_name ?></td>
                                </tr>
                                <?php $i++; } ?> 
                        </tbody>
                    </table>
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
			document.getElementById('regional').value = data.regional;


			
		 }
	 });
	};
	

	</script>
<script type="text/javascript">
$(document).ready(function() {

	var table = $('#invoicedatatables').DataTable({
        // "sScrollY": sScrollY + "px", // Set tinggi tabel
        "bPaginate": false, // Nonaktifkan paginasi
        "bJQueryUI": true, // Gunakan tema jQuery UI
        "bScrollCollapse": true, // Aktifkan gulir collapse
        "bAutoWidth": false, // Aktifkan penyesuaian lebar otomatis
    });

    // Bungkus tabel dengan div untuk membuat header tabel tetap
    $('#invoicedatatables').wrap('<div class="dataTables_scroll" />');

  

    // Menyesuaikan lebar kolom setelah konten tabel dimuat sepenuhnya
    $(window).on('load', function() {
        table.columns.adjust().draw();
    });
});
</script>