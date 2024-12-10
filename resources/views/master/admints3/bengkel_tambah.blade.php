
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/bengkel/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Bengkel Name</label>
					<div class="col-sm-9">
						<input type="text" name="bengkel_name" class="form-control" placeholder="Bengkel Name" value="{{ old('bengkel_name') }}" required>
					</div>
				</div>

				
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">PIC Bengkel</label>
					<div class="col-sm-9">
						<select name="pic_bengkel" id="pic_bengkel" class="form-control select2">
							<option selected disabled>Pilih</option>
							<?php foreach($userbengkel as $ub) { ?>
							  <option value="<?php echo $ub->username ?>"><?php echo $ub->fullname ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">phone</label>
					<div class="col-sm-9">
						<input type="text" name="phone" class="form-control" placeholder="phone" value="{{ old('phone') }}" required>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Address</label>
					<div class="col-sm-9">
						<textarea name="address" id="address" class="form-control" id="address" placeholder="Address">{{ old('address') }}</textarea>

					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Latitude</label>
					<div class="col-sm-9">
						<input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ old('latitude') }}" required >
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Longitude</label>
					<div class="col-sm-9">
						<input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ old('longitude') }}" required >
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



