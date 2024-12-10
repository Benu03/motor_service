
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/branch/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
				


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Client</label>
					<div class="col-sm-9">
						<select name="client" id="client" class="form-control select2" onchange="loadDataArea();loadDataClient()">
							<option selected disabled>Pilih</option>
							<?php foreach($client as $cl) { ?>
							  <option value="<?php echo $cl->client_name ?>"><?php echo $cl->client_name ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Area</label>
					<div class="col-sm-9">
						<select name="mst_area_id" id="mst_area_id" class="form-control select2">
							<option selected disabled>Pilih</option>
						
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Branch</label>
					<div class="col-sm-9">
						<input type="text" name="branch" class="form-control" placeholder="branch" value="{{ old('branch') }}" required>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">PIC Branch</label>
					<div class="col-sm-9">
						<select name="pic_branch" id="pic_branch" class="form-control select2">
							<option selected disabled>Pilih</option>
							
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Phone</label>
					<div class="col-sm-9">
						<input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" onkeypress="return isNumber(event)" >
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Address</label>
					<div class="col-sm-9">
						<textarea name="address" id="address" class="form-control" id="address" placeholder="Address">{{ old('address') }}</textarea>

					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-12 text-center">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
							<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>


<script>
	var loadDataArea= function(){
	const client = $("#client").val();
	console.log(client);
	
	 $.ajax({    
		headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
		 type: "POST",
		 url: "{{ asset('admin-ts3/get-area-client')}}", 
		 data:{client:client},      
		 dataType: "JSON",                  
		 success: function(data){   
			$('#mst_area_id').empty();
			$.each(data, function (id, area_slug) {
				$('#mst_area_id').append(new Option(id,area_slug))
			})

			
		 }
	 });
	};
	
</script>


<script>
	var loadDataClient = function(){
	const client = $("#client").val();
	console.log(client);
	
	 $.ajax({    
		headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
		 type: "POST",
		 url: "{{ asset('admin-ts3/get-pic-client')}}", 
		 data:{client:client},      
		 dataType: "JSON",                  
		 success: function(data){   
			$('#pic_branch').empty();
			$.each(data, function (username, nama) {
				$('#pic_branch').append(new Option(username,nama))
			})
			
			
		 }
	 });
	};
	
</script>





