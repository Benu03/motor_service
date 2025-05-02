<div class="modal fade" id="addService"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
					<div class="modal-header">
		
					<h4 class="modal-title mr-4" id="myModalLabel">Add Service</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form action="{{ asset('bengkel/invoice-create-detail-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							<div class="row form-group">   
								<div class="col-sm-12">
								<input type="hidden" name="invoice_no" value="{{ $invoice_no }}">
								<div class="form-group row">
									<label class="col-sm-3 control-label text-left">Service no</label>
									<div class="col-sm-9">
										<select name="service_no" class="form-control select2" id="service_no" onchange="loadDataService()">
											<option selected disabled>Pilih</option>
											<?php foreach($serviceinvoice as $si) { ?>
											<option value="<?php echo $si->service_no ?>"><?php echo $si->service_no.' Nopol ('.$si->nopol.') Area '.$si->area?></option>
											<?php } ?>													
											</select>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-3 control-label text-left">Tanggal Service</label>
									<div class="col-sm-9">
										<input type="text" name="tanggal_service" id="tanggal_service" class="form-control" placeholder="Tanggal Service" value="{{ old('tanggal_service') }}" readonly required>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-3 control-label text-left">Nopol</label>
									<div class="col-sm-9">
										<input type="text" name="nopol"   id="nopol" class="form-control" placeholder="Nopol" value="{{ old('nopol') }}" readonly required>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-3 control-label text-left">Cabang</label>
									<div class="col-sm-9">
										<input type="text" name="branch"  id="branch" class="form-control" placeholder="Cabang" value="{{ old('branch') }}"  readonly required>
									</div>
								</div>



								<div class="form-group row">
									<label class="col-sm-3 control-label text-left">Jasa</label>
									<div class="col-sm-9">			
										<select name="jasa_id[]" id="jasa_id" class="form-control select2" multiple="multiple">
											{{-- <?php foreach($priceJobs as $pr) { ?>
												<option value="<?php echo $pr->kode ?>"><?php echo $pr->kode,' ('.$pr->service_name.')' ?></option>
											  <?php } ?> --}}
										  </select>
									</div>
								</div>

								{{-- <div class="form-group row">
									<label class="col-sm-3 control-label text-left">Spare part</label>
									<div class="col-sm-9">			
										<select name="part_id[]" id="part_id" class="form-control select2" multiple="multiple">						
											<?php foreach($pricePart as $pr) { ?>
											  <option value="<?php echo $pr->kode ?>"><?php echo $pr->kode,' ('.$pr->service_name.')' ?></option>
											<?php } ?>
										  </select>
									</div>
								</div> --}}

								<div class="form-group row">
									<label class="col-sm-3 control-label text-right"></label>
									<div class="col-sm-9">
										<div class="form-group pull-right btn-group">
											<input type="submit" name="submit" class="btn btn-primary " value="Kirim Data">
											<input type="reset" name="reset" class="btn btn-success " value="Reset">
											<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
										</div>
									</div>
									<div class="clearfix"></div>
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
	
	
	</script>