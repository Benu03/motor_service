@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin-ts3/invoice-gps-detail-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="row">
   
    <div class="col-md-6">      

				<div class="form-group row">
					<label class="col-sm-3 control-label text-left">Invoice No</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="invoice_no" name="invoice_no" value="{{ $invoice_no }}" required readonly>
                            </div> 
					</div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button class="btn btn-success " type="button" data-toggle="modal" data-target="#addInvoicegps">
                                <i class="fas fa-plus-circle"></i> Add Invoice
                            </button>
                           
                           
                        </div>
					</div>
				</div>


                <div class="form-group row">
					<label class="col-sm-3 control-label text-left">Invoice Date</label>
					<div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="invoice_date" class="form-control tanggal" placeholder="Invoice Date" data-date-format="yyyy-mm-dd">	
                            </div> 
					</div>

				</div>
             
    </div>         
         


</div>

  
<div class="clearfix"><hr></div>


<div class="row">
								<div class="col-md-12">	


								        <div class="card">
											<div class="card-body">

														<div class="table-responsive mailbox-messages">
                                                        <table id="dataTable" class="display table table-bordered" cellspacing="0" width="100%">
															<thead>
																<tr class="bg-info">
																   <th>Invoice No</th>
                                                                   <th>Invoice Date</th>
                                                                   <th>Status Invoice</th>
																	<th>Client</th>  
                                                                    <th>Amount</th>  
                                                                    <th>Action</th>  
 
																	
															</tr>
															</thead>

                                                            </table>
</div>
</div>







<div class="modal fade" id="addInvoicegps"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width:1200px; max-height:1200px;" >
		<div class="modal-content">
					<div class="modal-header">
		
					<h4 class="modal-title mr-4" id="myModalLabel">Add Invoice GPS</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
							{{ csrf_field() }}
							
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
																																							<input type="checkbox"  class="form-control icheckbox_flat-blue" name="idgps[]" value="<?php echo $in->id ?>" id="check<?php echo $i ?>">
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
											<button class="btn btn-primary" type="submit"  >
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

             
					   
						     
				
                    </div>
		</div>
	</div>
</div>



</form>



<script type="text/javascript">
    $(document).ready(function() {
        // Ketika tombol unduh diklik
        $(".download-btn").click(function(e) {
            e.preventDefault(); // Menghentikan perilaku default tautan

            // Mengambil data invoice dari atribut 'data-invoice'
            var invoiceNo = $(this).data("invoice");

            $.ajax({
                headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
		 type: "POST",
		 url: "{{ asset('admin-ts3/invoice-gps-generate')}}", 
                data: { invoice_no: invoiceNo }, // Kirim data invoice ke controller
                xhrFields: {
                    responseType: 'blob' // Mengatur tipe respons menjadi blob
                },
                success: function(response, status, xhr) {
                    // Membuat URL objek blob
                    var url = window.URL.createObjectURL(response);

                    // Membuat elemen <a> sementara
                    var a = document.createElement("a");
                    a.style.display = "none";
                    a.href = url;
                    a.download = invoiceNo + ".pdf"; // Nama file yang diunduh
                    document.body.appendChild(a);
                    a.click(); // Memulai unduhan
                    window.URL.revokeObjectURL(url); // Bebaskan sumber daya URL
                },
                error: function(xhr, status, error) {
                    // Penanganan kesalahan jika diperlukan
                    console.error(error);
                }
            });
        });
    });
</script>




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




<script type="text/javascript">
    $(document).ready(function() { 
        fetch_data()
        function fetch_data(){                    
                $('#dataTable').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    oLanguage: {
                        sZeroRecords: "Tidak Ada Data",
                        sSearch: "Pencarian _INPUT_",
                        sLengthMenu: "_MENU_",
                        sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        sInfoEmpty: "0 data",
                        oPaginate: {
                            sNext: "<i class='fa fa-angle-right'></i>",
                            sPrevious: "<i class='fa fa-angle-left'></i>"
                        }
                    },
                    ajax: {
                        url:"{{  asset('admin-ts3/get-invoice-gps') }}",
                        type: "GET"
                             
                    },
                    columns: [
                       
                        {
                            name: 'invoice_no',
                            data: 'invoice_no'
                        },
                        {
                            name: 'invoice_date',
                            data: 'invoice_date'
                        },
                        {
                            name: 'status_invoice',
                            data: 'status_invoice'
                        },
                        {
                            name: 'client_invoice',
                            data: 'client_invoice'
                        },
                        {
                            name: 'amount',
                            data: function(row) {
     
                            return 'Rp ' + row.amount.toLocaleString('id-ID');
                        }
                                            },
                        {
                            data: 'action', 
                            name: 'action', 
                            className: "text-center",
                            orderable: false, 
                            searchable: false
                           
                        },
                    ]
                });
            }         
    });
    </script>

    

<script>
$(document).on("click", ".delete-btn", function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    console.log(url);
    swal({
        title: "Yakin akan menghapus data ini?",
        icon: "warning",
        buttons: true,
        cancel: {
            text: "Cancel",
            value: null,
            visible: false,
            className: "",
            closeModal: true,
        },
        confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "",
            closeModal: true
        },
        buttonsStyling: false,

        closeModal: false

    }).then(function(isConfirm) {
        if (isConfirm) {
            // Jika pengguna mengonfirmasi, lakukan penghapusan menggunakan AJAX
            $.ajax({
                url: url,
                success: function(resp) {
                    
                    window.location.href = url;
                }
            });
        } else {
            swal.close();
        }
    });
});
</script>




<script>
$(document).on("click", ".download-btn", function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    console.log(url);
    swal({
        title: "Apakah anda ingin generate invoice?",
        icon: "info",
        buttons: true,
        cancel: {
            text: "Cancel",
            value: null,
            visible: false,
            className: "",
            closeModal: true,
        },
        confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "",
            closeModal: true
        },
        buttonsStyling: false,

        closeModal: false

    }).then(function(isConfirm) {
        if (isConfirm) {
            console.log('download');
            $.ajax({
                url: url,
                success: function(resp) {
                    
                    window.location.href = url;
                 
                        refreshDataTable();
                 

                }
            });

    

        } else {
            swal.close();
        }
    });
});




$(document).on("click", ".finish-btn", function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    console.log(url);
    swal({
        title: "Apakah anda ingin menyelesaikan Invoice ini?",
        icon: "info",
        buttons: true,
        cancel: {
            text: "Cancel",
            value: null,
            visible: false,
            className: "",
            closeModal: true,
        },
        confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "",
            closeModal: true
        },
        buttonsStyling: false,

        closeModal: false

    }).then(function(isConfirm) {
        if (isConfirm) {
           
            $.ajax({
                url: url,
                success: function(resp) {
                    
                       
                 
                        refreshDataTable(); 
                        swal ( "Berhasil" ,  "Invoice berhasil di" ,  "success" )

                }   
            });

    

        } else {
            swal.close();
        }
    });
});


function refreshDataTable() {
    $('#dataTable').DataTable().ajax.reload();
}
</script>