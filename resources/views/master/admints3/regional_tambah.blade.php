
<div class="modal fade" id="Tambah"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/regional/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
				
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Client</label>
					<div class="col-sm-9">
						<select name="mst_client_id" id="mst_client_id" class="form-control select2" onchange="loadDataClient()">

							<?php foreach($client as $cl) { ?>
							  <option value="<?php echo $cl->id ?>"><?php echo $cl->client_name ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Regional</label>
					<div class="col-sm-9">
						<input type="text" name="regional" class="form-control" placeholder="Regional" value="{{ old('regional') }}" required>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">PIC Regional</label>
					<div class="col-sm-9">
						<select name="pic_regional" id="pic_regional" class="form-control select2">
							<option selected disabled>Pilih</option>
							
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-9">
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
	var loadDataClient = function(){
	const mst_client_id = $("#mst_client_id").val();
	console.log(mst_client_id);
	
	 $.ajax({    
		headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
		 type: "POST",
		 url: "{{ asset('admin-ts3/get-pic-regional')}}", 
		 data:{mst_client_id:mst_client_id},      
		 dataType: "JSON",                  
		 success: function(data){   
			$('#pic_regional').empty();
			$.each(data, function (username, nama) {
				$('#pic_regional').append(new Option(username,nama))
			})
			
			
		 }
	 });
	};
	
</script>




