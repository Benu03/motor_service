
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/vehicle/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
				 
			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Client</label>
				<div class="col-sm-9">
					<select name="mst_client_id" id="mst_client_id" class="form-control select2">
					
						<?php foreach($client as $cl) { ?>
						<option value="<?php echo $cl->id ?>"><?php echo $cl->client_name ?></option>
						<?php } ?>
					</select>
				</div>
			</div>



				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nopol</label>
					<div class="col-sm-9">
						<input type="text" name="nopol" class="form-control" placeholder="Nopol" value="{{ old('nopol') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">No Rangka</label>
					<div class="col-sm-9">
						<input type="text" name="norangka" class="form-control" placeholder="No Rangka" value="{{ old('norangka') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">No Mesin</label>
					<div class="col-sm-9">
						<input type="text" name="nomesin" class="form-control" placeholder="No Mesin" value="{{ old('nomesin') }}" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Type</label>
					<div class="col-sm-9">
						<select name="mst_vehicle_type_id" id="mst_vehicle_type_id" class="form-control select2">
							<?php foreach($vehicle_type as $vtt) { ?>
							  <option value="<?php echo $vtt->id ?>"><?php echo $vtt->type ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Remark</label>
					<div class="col-sm-9">
						<textarea name="remark" class="form-control" id="remark" placeholder="Remark">{{ old('remark') }}</textarea>

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



