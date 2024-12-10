
<div class="modal fade" id="Tambah_vehicle_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/vehicle-type/tambah-vehicle-type') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Group</label>
					<div class="col-sm-9">
						<select name="group_vehicle" id="group_vehicle" class="form-control select2">
						
							<?php foreach($group_vehicle as $gv) { ?>
							  <option value="<?php echo $gv->value_1 ?>"><?php echo $gv->value_1 ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Type</label>
					<div class="col-sm-9">
						<input type="text" name="type" class="form-control" placeholder="Type" value="{{ old('type') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Tahun</label>
					<div class="col-sm-9">
						<input type="text" name="tahun_pembuatan" class="form-control" placeholder="Tahun" value="{{ old('tahun_pembuatan') }}"  onkeypress="return isNumber(event)" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Deskripsi</label>
					<div class="col-sm-9">
						<textarea name="desc" id="address" class="form-control" id="desc" placeholder="Deskripsi">{{ old('desc') }}</textarea>

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



